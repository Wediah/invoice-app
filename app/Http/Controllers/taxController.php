<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Tax;
use Illuminate\Http\Request;

class taxController extends Controller
{
    public function index($slug)
    {
        $company = Company::where('slug', $slug)->firstOrFail();
        $taxes = $company->taxes;

        return view('tax.index', compact('taxes', 'company'));
    }

    public function create($slug)
    {
        $company = Company::where('slug', $slug)->firstOrFail();

        return view('tax.create', compact('company'));
    }

    public function store($slug)
    {
        $company = Company::where('slug', $slug)->firstOrFail();

        $validatedData = request()->validate([
            'tax_name' => 'required|string|max:255',
            'tax_percentage' => 'required|numeric|between:0,100',
            'type' => 'required|string|in:primary,secondary',
        ]);

        $taxData = array(
            'company_id' => $company->id,
            'tax_name' => $validatedData['tax_name'],
            'tax_percentage' => $validatedData['tax_percentage'],
            'type' => $validatedData['type'],
        );

        Tax::create($taxData);

        return redirect()->back()->with('success', 'Tax added successfully!');
//        return redirect()->route('tax.index')->with('success', 'Tax created successfully.');
    }

    public function edit()
    {
        return view('tax.edit');
    }

    public function update(string $id)
    {
        $tax = Tax::findOrFail($id);

        $validated = request()->validate([
            'tax_name' => 'sometimes',
            'tax_percentage' => 'sometimes',
            'type' => 'sometimes|in:primary,secondary',
        ]);

        $editTax = [
            'tax_name' => $validated['tax_name'],
            'tax_percentage' => $validated['tax_percentage'],
            'type' => $validated['type'],
        ];

        $tax->update($editTax);

        return redirect()->route('tax.index')->with('success', 'Tax updated successfully.');
    }

    public function destroy(String $id)
    {
        $tax = Tax::findOrFail($id);

        $tax->delete();

        return redirect()->route('tax.index')->with('success', 'Tax deleted successfully.');
    }
}
