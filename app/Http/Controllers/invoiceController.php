<?php

namespace App\Http\Controllers;

use App\invoiceStatus;
use App\Models\Catalog;
use App\Models\Company;
use App\Models\customerInfo;
use App\Models\invoice;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
            'tax_id.*' => 'required|exists:taxes,id',
            'discount_percent.*' => 'numeric|nullable|min:0',
            'customer_email' => 'string|email|nullable|max:255',
            'customer_phone' => 'string|nullable|max:255',
            'customer_address' => 'string|nullable|max:255',
            'customer_mobile' => 'string|nullable|max:255',
            'due_date' => 'required|string|max:255',
            'notes' => 'string|nullable|max:255',
            'total' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'salesperson' => 'required|string|max:255'
        ]);

        try {
            DB::transaction(function () use ($validatedData, $company, $request) {
                $user_id = Auth::id();
                $invoiceNumber = $this->generateInvoiceNumber($company);

                $invoice = Invoice::create([
                    'user_id' => $user_id,
                    'company_id' => $company->id,
                    'invoice_number' => $invoiceNumber,
                    'due_date' => $validatedData['due_date'],
                    'notes' => $validatedData['notes'],
                    'total' => $validatedData['total'],
                    'salesperson' => $validatedData['salesperson'],
                ]);

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

            return redirect()->route('invoice.show', ['slug' => $company->slug, 'id' => $invoice->id])
                ->with('success', 'Invoice Created Successfully!');
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
        $items = $request->input('group-a', []);
        $processedItems = [];

        foreach ($items as $item) {
            $processedItems[$item['catalog_id']] = [
                'quantity' => $item['quantity'],
                'discount_percent' => $item['discount_percent'],
            ];
        }

        $invoice->catalogs()->attach($processedItems);

        $taxIds = $request->input('tax_ids', []);
        if (is_array($taxIds)) {
            $invoice->taxes()->attach($taxIds);
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
    public function edit($slug,string $id): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        $company = Company::where('slug', $slug)->firstOrFail();
        $invoice = invoice::with('company', 'taxes')->where('id', $id)->firstOrFail();
        $allCatalogs = $company->catalogs;
        $invoiceCatalogs = $company->catalogs->pluck('id')->toArray();
        $allTaxes = $company->taxes;
        $invoiceTaxes = $invoice->taxes->pluck('id')->toArray();

        return view('invoice.edit', compact('invoice', 'company', 'allCatalogs', 'invoiceCatalogs', 'allTaxes', 'invoiceTaxes'));
    }

    public function paidInvoice(string $id): RedirectResponse
    {
        $paidInvoice = invoice::findOrFail($id);
        $paidInvoice->status = invoiceStatus::PAID->value;
        $paidInvoice->save();

        return redirect()->back();
    }

    public function unpaidInvoice(string $id): RedirectResponse
    {
        $unpaidInvoice = invoice::findOrFail($id);
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
