<?php

namespace App\Http\Controllers;

use App\Models\Tax;
use App\invoiceStatus;
use App\Models\Catalog;
use App\Models\Company;
use App\Models\invoice;
use App\Models\customerInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;

class invoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($slug): Factory|Application|View
    {
        $company = Company::where('slug', $slug)->firstOrFail();
        $allInvoices = $company->invoices->sortByDesc('created_at');

        return view('invoice.index', compact('company', 'allInvoices'));
    }

    public function unpaidInvoices($slug): Factory|Application|View
    {
        $company = Company::where('slug', $slug)->firstOrFail();
        $unpaidInvoices = $company->invoices->where('status', 'unpaid');

        return view('invoice.unpaid', compact('company', 'unpaidInvoices'));
    }

    public function paidInvoices($slug): Factory|Application|View
    {
        $company = Company::where('slug', $slug)->firstOrFail();
        $paidInvoices = $company->invoices->where('status', 'paid');

        return view('invoice.paid', compact('company', 'paidInvoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($slug)
    {
        $user = Auth::user();
        $company = Company::where('slug', $slug)->firstOrFail();
        $catalogs = $company->catalogs;
        $taxes = $company->taxes;
        $invoiceNumber = $this->generateInvoiceNumber($company);

        return view('invoice.create', compact('company', 'catalogs', 'user', 'taxes', 'invoiceNumber'));
    }

    /**
     * Generate a unique invoice number.
     */
    private function generateInvoiceNumber($company): string
    {
        $latestInvoice = Invoice::where('company_id', $company->id)
            ->where('invoice_number', 'NOT REGEXP', '^UP')
            ->orderBy('created_at', 'desc')
            ->first();

        if ($latestInvoice) {
            preg_match('/\d+$/', $latestInvoice->invoice_number, $matches);
            $latestNumber = $matches ? intval($matches[0]) : 0;
        } else {
            $latestNumber = $company->invoice_numbering;
        }

        return strtoupper($company->invoice_prefix) . '-' . ++$latestNumber;
    }

    public function getPrice(Request $request)
    {
        $itemId = $request->id;
        $item = Catalog::find($itemId);  // Assuming 'Catalog' is your model name

        if ($item) {
            return response()->json(['price' => $item->price]);  // Assuming 'price' is the attribute for the price
        } else {
            return response()->json(['error' => 'Item not found'], 404);
        }
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $slug)
    {
        $company = Company::where('slug', $slug)->firstOrFail();
        $validatedData = $request->validate([
            'customer_name' => 'required|string|max:255',
            'catalog_id.*' => 'required|exists:catalogs,id',
            'quantity.*' => 'required|integer|min:1',
            'item-sub_total.*' => 'required', //items selected total
            'tax_id.*' => 'required|exists:taxes,id',
            'discount_percent.*' => 'numeric|nullable|min:0',
            'customer_email' => 'string|email|nullable|max:255',
            'customer_phone' => 'string|nullable|max:255',
            'customer_address' => 'string|nullable|max:255',
            'customer_mobile' => 'string|nullable|max:255',
            'due_date' => 'required|string|max:255',
            'notes' => 'string|nullable|max:255',
            'subtotal' => 'required|numeric',
            'subtotalAfterDiscount' => 'required|numeric',
            'total_discount' => 'required|numeric',
            'tax_total' => 'required|numeric',
            'total' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'salesperson' => 'required|string|max:255'
        ]);

        try {
            // Initialize $invoice outside the closure
            $invoice = null;

            DB::transaction(function () use ($validatedData, $company, $request, &$invoice) {
                $user_id = Auth::id();
                $invoiceNumber = $this->generateInvoiceNumber($company);

                // Create the invoice
                $invoice = Invoice::create([
                    'user_id' => $user_id,
                    'company_id' => $company->id,
                    'invoice_number' => $invoiceNumber,
                    'due_date' => $validatedData['due_date'],
                    'notes' => $validatedData['notes'],
                    'subtotal' => $validatedData['subtotal'],
                    'subtotalAfterDiscount' => $validatedData['subtotalAfterDiscount'],
                    'tax_total' => $validatedData['tax_total'],
                    'discount_total' => $validatedData['total_discount'],
                    'final_total' => $validatedData['total'],
                    'salesperson' => $validatedData['salesperson'],
                ]);

                if (!$invoice) {
                    throw new \Exception('Failed to create invoice');
                }

                // Create customer info linked to the invoice
                CustomerInfo::create([
                    'invoice_id' => $invoice->id,
                    'company_id' => $company->id,
                    'customer_name' => $validatedData['customer_name'],
                    'customer_email' => $validatedData['customer_email'],
                    'customer_phone' => $validatedData['customer_phone'],
                    'customer_address' => $validatedData['customer_address'],
                    'customer_mobile' => $validatedData['customer_mobile'],
                ]);

                $this->attachItemsAndTaxes($request, $invoice);
            });

            // After the transaction, $invoice should now contain the created invoice instance
            if ($invoice) {
                return redirect()->route('invoice.show', ['slug' => $company->slug, 'id' => $invoice->id])
                    ->with('success', 'Invoice Created Successfully!');
            } else {
                return redirect()->back()->with('error', 'Failed to create invoice. Please try again.');
            }
        } catch (\Exception $e) {
            Log::error('Error creating invoice: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to create invoice. Please try again.');
        }
    }

    /**
     * Attach items and taxes to an invoice.
     */
    private function attachItemsAndTaxes(Request $request, $invoice): void
    {
        // Attach Items to Invoice
        $items = $request->input('group-a', []);
        $processedItems = [];

        foreach ($items as $item) {
            $processedItems[$item['catalog_id']] = [
                'quantity' => $item['quantity'],
                'discount_percent' => $item['discount_percent'],
                'total' => $item['item-sub_total'],
            ];
        }


        $invoice->catalogs()->attach($processedItems);

        $primaryTaxTotal = 0;
        $secondaryTaxes = [];

        $taxIds = $request->input('tax_ids', []);
        if (is_array($taxIds)) {
            // First pass: Calculate primary taxes
            foreach ($taxIds as $taxId) {
                $tax = Tax::find($taxId);
                if ($tax && $tax->type == 'PRIMARY') {
                    $taxAmount = $invoice->subtotalAfterDiscount * ($tax->tax_percentage / 100);
                    $primaryTaxTotal += $taxAmount;
                  
                    $invoice->taxes()->attach($taxId, [
                        'tax_type' => $tax->type,
                        'tax_percentage' => $tax->tax_percentage,
                        'tax_amount' => $taxAmount
                    ]);
                } elseif ($tax && $tax->type == 'SECONDARY') {
                    $secondaryTaxes[] = $tax;
                }
            }

            // Second pass: Calculate and attach secondary taxes
            $baseForSecondary = $invoice->subtotalAfterDiscount + $primaryTaxTotal;
            foreach ($secondaryTaxes as $tax) {
                $taxAmount = $baseForSecondary * ($tax->tax_percentage / 100);
               
                $invoice->taxes()->attach($tax->id, [
                    'tax_type' => $tax->type,
                    'tax_percentage' => $tax->tax_percentage,
                    'tax_amount' => $taxAmount
                ]);
            }
        }
    }


    /**
     * Display the specified resource.
     */
    public function show($slug, $id)
    {
        $user = Auth::user();
        $company = Company::where('slug', $slug)->firstOrFail();
        $invoice = Invoice::with('catalogs', 'taxes', 'customerInfo')->findOrFail($id);

        return view('invoice.show', compact('invoice', 'user', 'company'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug, string $id): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        $company = Company::where('slug', $slug)->firstOrFail();
        $invoice = Invoice::with('company', 'taxes')->where('id', $id)->firstOrFail();
        $allCatalogs = $company->catalogs;
        $invoiceCatalogs = $company->catalogs->pluck('id')->toArray();
        $allTaxes = $company->taxes;
        $invoiceTaxes = $invoice->taxes->pluck('id')->toArray();

        return view('invoice.edit', compact('invoice', 'company', 'allCatalogs', 'invoiceCatalogs', 'allTaxes', 'invoiceTaxes'));
    }

    public function paidInvoice(string $id): RedirectResponse
    {
        $paidInvoice = Invoice::findOrFail($id);
        $paidInvoice->status = invoiceStatus::PAID->value;
        $paidInvoice->save();

        return redirect()->back();
    }

    public function unpaidInvoice(string $id): RedirectResponse
    {
        $unpaidInvoice = Invoice::findOrFail($id);
        $unpaidInvoice->status = invoiceStatus::UNPAID->value;
        $unpaidInvoice->save();

        return redirect()->back();
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $invoice = Invoice::findOrFail($id);

        $validatedData = $request->validate([
            'customer_name' => 'required|string|max:255',
            'catalog_id.*' => 'required|exists:catalogs,id',
            'quantity.*' => 'required|integer|min:1',
            'discount_percent.*' => 'numeric|min:0',
            'customer_email' => 'string|email|nullable|max:255',
            'customer_phone' => 'string|nullable|max:255',
            'customer_address' => 'string|nullable|max:255',
            'customer_mobile' => 'string|nullable|max:255',
            'due_date' => 'string|nullable|max:255',
            'notes' => 'string|nullable|max:255',
        ]);

        try {
            DB::transaction(function () use ($validatedData, $invoice, $request) {
                $invoice->update([
                    'due_date' => $validatedData['due_date'] ?? $invoice->due_date,
                    'notes' => $validatedData['notes'] ?? $invoice->notes,
                    'total' => $validatedData['total'] ?? $invoice->total,
                    'salesperson' => $validatedData['salesperson'] ?? $invoice->salesperson,
                ]);

                $invoice->customerInfo->update([
                    'customer_name' => $validatedData['customer_name'] ?? $invoice->customerInfo->customer_name,
                    'customer_email' => $validatedData['customer_email'] ?? $invoice->customerInfo->customer_email,
                    'customer_phone' => $validatedData['customer_phone'] ?? $invoice->customerInfo->customer_phone,
                    'customer_address' => $validatedData['customer_address'] ?? $invoice->customerInfo->customer_address,
                    'customer_mobile' => $validatedData['customer_mobile'] ?? $invoice->customerInfo->customer_mobile,
                ]);

                $this->attachItemsAndTaxes($request, $invoice);
            });

            return redirect()->route('invoice.show', ['slug' => $invoice->company->slug, 'id' => $invoice->id])
                ->with('success', 'Invoice updated successfully!');
        } catch (\Exception $e) {
            Log::error('Error updating invoice: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update invoice. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        try {
            $deleteInvoice = Invoice::findOrFail($id);
            $deleteInvoice->delete();
            usleep(500000);


            return redirect()->back()->with('success', 'Invoice deleted successfully');
        } catch (\Exception $e) {
            Log::error('Error deleting invoice: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete invoice. Please try again.');
        }
    }

    /**
     * @param Request $request
     * @param $invoice
     * @return void
     */


    /**
     * Download the invoice as a PDF.
     */
    public function downloadPDF($id): \Illuminate\Http\Response
    {
        $invoice = Invoice::where('id', $id)->firstOrFail();

        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        $pdf = PDF::loadView('invoice.show', compact('invoice'));

        return $pdf->download('invoice' . $invoice->invoice_number . '.pdf');
    }
}
