<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\Company;
use App\Models\invoice;
use App\Models\paymentTerms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class invoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        return view('invoice.create', compact('company', 'catalogs', 'user', 'taxes'));
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
            'discount' => 'integer|min:1',
            'email' => 'string|email|nullable|max:255',
            'phone' => 'string|nullable|max:255',
            'address' => 'string|nullable|max:255',
            'mobile' => 'string|nullable|max:255',
            'fax' => 'string|nullable|max:255',
        ]);

        $companySuffix = $company->invoice_numbering += 1;
        $invoiceNumber = strtoupper($company->invoice_prefix) . '-' . $companySuffix;

        $invoice = Invoice::create([
            'user_id' => $user_id,
            'company_id' => $company_id,
            'invoice_number' => $invoiceNumber,
            'customer_name' => $validatedData['customer_name'],
            'discount' => $validatedData['discount'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'address' => $validatedData['address'],
            'mobile' => $validatedData['mobile'],
            'fax' => $validatedData['fax'],
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
        $invoice = invoice::with('catalogs', 'taxes')->findOrFail($id);
        return view('invoice.show', compact('invoice'));
    }

    //terms of invoice
    public function showTerms()
    {
        return view('invoice.terms');
    }

    public function terms($slug)
    {
        $company = Company::where('slug', $slug)->firstOrFail();

        $validatedData = request()->validate([
            'company_id' => $company->id,
            'name' => 'required|string|max:255',
        ]);

        paymentTerms::firstOrCreate($validatedData);

        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
    public function destroy(string $id)
    {
        //
    }
}
