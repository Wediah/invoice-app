<?php

namespace App\Http\Controllers;

use App\invoiceStatus;
use App\Models\Catalog;
use App\Models\Company;
use App\Models\customerInfo;
use App\Models\invoice;
use App\Models\paymentTerms;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Log;

class invoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($slug): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        $company = Company::where('slug', $slug)->firstOrFail();
        $allInvoices = $company->invoices->sortByDesc('created_at');

        return view('invoice.index', compact('company', 'allInvoices'));
    }

    public function unpaidInvoices($slug): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        $company = Company::where('slug', $slug)->firstOrFail();
        $unpaidInvoices = $company->invoices->where('status', 'unpaid');

        return view('invoice.unpaid', compact('company', 'unpaidInvoices'));
    }

    public function paidInvoices($slug): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
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
        $company_id = $company->id;
        $catalogs = $company->catalogs;
        $taxes = $company->taxes;
        $latestInvoice = invoice::where('company_id', $company_id)
            ->orderBy('created_at', 'desc')
            ->first();

        if ($latestInvoice) {
            $latestInvoiceNumber = $latestInvoice->invoice_number;
            preg_match('/\d+$/', $latestInvoiceNumber, $matches);
            $latestNumber = $matches ? intval($matches[0]) : 0;
        } else {
            $latestNumber = $company->invoice_numbering;
        }

        $invoiceSuffix = $latestNumber += 1;
        $invoiceNumber = strtoupper($company->invoice_prefix) . '-' . $invoiceSuffix;
        return view('invoice.create', compact('company', 'catalogs', 'user', 'taxes', 'latestInvoice', 'invoiceNumber'));
    }

    // public function getPrice(Request $request)
    // {
    //     $catalog = Catalog::find($request->id);

    //     if ($catalog) {
    //         return response()->json(['price' => $catalog->price]);
    //     } else {
    //         return response()->json(['error' => 'Catalog not found'], 404);
    //     }
    // }
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
        $user_id = Auth::id();

        $company = Company::where('slug', $slug)->firstOrFail();
        $company_id = $company->id;

        $validatedData = request()->validate([
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

        $latestInvoice = invoice::where('company_id', $company_id)
            ->orderBy('created_at', 'desc')
            ->first();

        if ($latestInvoice) {
            $latestInvoiceNumber = $latestInvoice->invoice_number;
            preg_match('/\d+$/', $latestInvoiceNumber, $matches);
            $latestNumber = $matches ? intval($matches[0]) : 0;
        } else {
            $latestNumber = $company->invoice_numbering;
        }

        $invoiceSuffix = $latestNumber += 1;
        $invoiceNumber = strtoupper($company->invoice_prefix) . '-' . $invoiceSuffix;

        $invoice = Invoice::create([
            'user_id' => $user_id,
            'company_id' => $company_id,
            'invoice_number' => $invoiceNumber,
            'due_date' => $validatedData['due_date'],
            'notes' => $validatedData['notes'],
            'total' => $validatedData['total'],
            'salesperson' => $validatedData['salesperson'],
        ]);

        $customerInfo = CustomerInfo::create([
            'invoice_id' => $invoice->id,
            'customer_name' => $validatedData['customer_name'],
            'customer_email' => $validatedData['customer_email'],
            'customer_phone' => $validatedData['customer_phone'],
            'customer_address' => $validatedData['customer_address'],
            'customer_mobile' => $validatedData['customer_mobile'],
        ]);

        $this->extracted($request, $invoice);

        return redirect()->route('invoice.show', $invoice->id)->with('success', 'Product added to cart successfully!');
//        return redirect()->back()->with('success', 'Invoice Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = Auth::user();
        $invoice = invoice::with('catalogs', 'taxes', 'customerInfo')->findOrFail($id);

        return view('invoice.show', compact('invoice', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        $invoice = invoice::with('company')->where('id', $id)->firstOrFail();
        $company = $invoice->company;
        $catalogs = $company->catalogs;
        $taxes = $company->taxes;

        return view('invoice.edit', compact('invoice', 'company', 'catalogs', 'taxes'));
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
        $invoice = invoice::findOrFail($id);

        $user_id = Auth::id();

        $company_id = $invoice->company_id;

        $validatedData = $request->validate([
            'customer_name' => 'required|string|max:255',
            'catalog_id.*' => 'required|exists:catalogs,id',
            'quantity.*' => 'required|integer|min:1',
            'tax_id.*' => 'required|exists:taxes,id',
            'discount_percent.*' => 'numeric|min:0',
            'customer_email' => 'string|email|nullable|max:255',
            'customer_phone' => 'string|nullable|max:255',
            'customer_address' => 'string|nullable|max:255',
            'customer_mobile' => 'string|nullable|max:255',
            'due_date' => 'string|nullable|max:255',
            'notes' => 'string|nullable|max:255',
            'total' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'salesperson' => 'required|string|max:255'
        ]);

        $latestInvoiceNumber = $invoice->invoice_number;

        $updatedInvoiceNumber = 'UP'.$latestInvoiceNumber ;

        $invoice = Invoice::create([
            'user_id' => $user_id,
            'company_id' => $company_id,
            'invoice_number' => $updatedInvoiceNumber,
            'due_date' => $validatedData['due_date'] ?? $invoice->due_date,
            'notes' => $validatedData['notes'] ?? $invoice->notes,
            'total' => $validatedData['total'] ?? $invoice->total,
            'salesperson' => $validatedData['salesperson'] ?? $invoice->salesperson,
        ]);

        $customerInfo = CustomerInfo::create([
            'invoice_id' => $invoice->id,
            'customer_name' => $validatedData['customer_name'] ?? $invoice->customer_name,
            'customer_email' => $validatedData['customer_email'] ?? $invoice->customer_email,
            'customer_phone' => $validatedData['customer_phone'] ?? $invoice->customer_phone,
            'customer_address' => $validatedData['customer_address'] ?? $invoice->customer_address,
            'customer_mobile' => $validatedData['customer_mobile'] ?? $invoice->customer_mobile,
        ]);

        $this->extracted($request, $invoice);

        return redirect()->route('invoice.show', $invoice->id)->with('success', 'Invoice updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $deleteInvoice = Invoice::findOrFail($id);

        $deleteInvoice->delete();

        return redirect()->back()->with('success', 'Invoice deleted successfully');
    }

    /**
     * @param Request $request
     * @param $invoice
     * @return void
     */
    public function extracted(Request $request, $invoice): void
    {
        $items =  $request->input('group-a', []);

        foreach ($items as $item) {
            $processedItems[$item['catalog_id']] = [
                'quantity' => $item['quantity'],
                'discount_percent' => $item['discount_percent'],
            ];
        }

        $invoice->catalogs()->attach($processedItems);

        $taxes = [];
        $taxIds = $request->input('tax_ids', []); // Assuming $taxIds comes from a request

        // Ensure $taxIds is an array
        if (!is_array($taxIds)) {
            $taxIds = [];
        }

        foreach ($taxIds as $taxId) {
            $taxes[] = $taxId;
        }

        $invoice->taxes()->attach($taxes);
    }

    public function downloadPDF($id): \Illuminate\Http\Response
    {
        $invoice = invoice::where('id', $id)->firstOrFail();

        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        $pdf = PDF::loadView('invoice.show', compact('invoice'));

        return $pdf->download('invoice'.$invoice->invoice_number.'.pdf');
    }
}
