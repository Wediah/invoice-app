<?php

namespace App\Http\Controllers;

use App\Enums\directoryStatus;
use App\Events\DirectoryApproved;
use App\invoiceStatus;
use App\Models\Catalog;
use App\Models\Company;
use App\Models\Directory;
use App\Models\invoice;
use App\Models\paymentTerms;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class invoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($slug)
    {
        $company = Company::where('slug', $slug)->firstOrFail();
        $allInvoices = $company->invoices->sortByDesc('created_at');

        return view('invoice.index', compact('company', 'allInvoices'));
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

    public function getPrice(Request $request)
    {
        $catalog = Catalog::find($request->id);

        if ($catalog) {
            return response()->json(['price' => $catalog->price]);
        } else {
            return response()->json(['error' => 'Catalog not found'], 404);
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
            'term_id' => 'required|exists:payment_terms,id',
            'quantity.*' => 'required|integer|min:1',
            'tax_id.*' => 'required|exists:taxes,id',
            'discount' => 'numeric|min:0',
            'email' => 'string|email|nullable|max:255',
            'phone' => 'string|nullable|max:255',
            'address' => 'string|nullable|max:255',
            'mobile' => 'string|nullable|max:255',
            'fax' => 'string|nullable|max:255',
            'due_date' => 'string|nullable|max:255',
            'notes' => 'string|nullable|max:255',
            'total' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'balance' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
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
            'term_id' => $validatedData['term_id'],
            'customer_name' => $validatedData['customer_name'],
            'discount' => $validatedData['discount'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'address' => $validatedData['address'],
            'mobile' => $validatedData['mobile'],
            'fax' => $validatedData['fax'],
            'due_date' => $validatedData['due_date'],
            'notes' => $validatedData['notes'],
            'total' => $validatedData['total'],
            'balance' => $validatedData['balance'],
            'salesperson' => $validatedData['salesperson'],
        ]);

        $catalogIds = $request->input('catalog_id');
        $quantities = $request->input('quantity');

        $items = [];
        for ($i = 0; $i < count($catalogIds); $i++) {
            $items[] = [
                'catalog_id' => $catalogIds[$i],
                'quantity' => $quantities[$i],
            ];
        }

        $invoice->catalogs()->attach($items);

        $taxIds = $request->input('tax_id');

        $taxes = [];
        foreach ($taxIds as $taxId) {
            $taxes[] = $taxId;
        }

        $invoice->taxes()->attach($taxes);

        return redirect()->route('invoice.show', $invoice->id)->with('success', 'Product added to cart successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = Auth::user();
        $invoice = invoice::with('catalogs', 'taxes', 'paymentTerms')->findOrFail($id);

        return view('invoice.show', compact('invoice', 'user'));
    }

    //terms of invoice
    public function showTerms($slug)
    {
        $company = Company::where('slug', $slug)->firstOrFail();

        return view('invoice.terms', compact('company'));
    }

    public function terms($slug)
    {
        $company = Company::where('slug', $slug)->firstOrFail();

        $validatedData = request()->validate([
            'name' => 'required|string|max:255',
        ]);

        $terms = array(
            'company_id' => $company->id,
            'name' => $validatedData['name'],
        );

        paymentTerms::firstOrCreate($terms);

        return redirect()->back();
    }

    public function downloadPDF($id): \Illuminate\Http\Response
    {
        $invoice = invoice::where('id', $id)->firstOrFail();

        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        $pdf = PDF::loadView('invoice.show', compact('invoice'));

        return $pdf->download('invoice.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $invoice = invoice::with('company')->where('id', $id)->firstOrFail();
        $company = $invoice->company;

        return view('invoice.edit', compact('invoice', 'company'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $deleteInvoice = Invoice::findOrFail($id);

        $deleteInvoice->delete();

        return redirect()->intended(route('invoice.index', absolute: false));
    }
}
