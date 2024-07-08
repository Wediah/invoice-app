<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\Company;
use App\Models\invoice;
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
        return view('invoice.create', compact('company', 'catalogs', 'user'));
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
            'quantity.*' => 'required|integer|min:1'
        ]);

        $invoice = Invoice::create([
            'user_id' => $user_id,
            'company_id' => $company_id,
            'invoice_number' => strtoupper(uniqid('INV-')),
            'customer_name' => $validatedData['customer_name'],
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

        return redirect()->route('invoice.show', $invoice->id)->with('success', 'Product added to cart successfully!');
//        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $invoice = invoice::with('catalogs')->findOrFail($id);
        return view('invoice.show', compact('invoice'));
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
