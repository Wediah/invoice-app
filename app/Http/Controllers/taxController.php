<?php

namespace App\Http\Controllers;

use App\Models\Tax;
use Illuminate\Http\Request;

class taxController extends Controller
{
    public function index()
    {
        return view('tax.index');
    }

    public function create()
    {
        return view('tax.create');
    }

    public function store()
    {
        $validatedData = request()->validate([
            'tax_name' => 'required',
            'tax_percentage' => 'required',
        ]);

        $taxData = array(
            'tax_name' => $validatedData['tax_name'],
            'tax_percentage' => $validatedData['tax_percentage'],
        );

        tax::create($taxData);

        return redirect()->route('tax.index')->with('success', 'Tax created successfully.');
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
        ]);

        $editTax = [
            'tax_name' => $validated['tax_name'],
            'tax_percentage' => $validated['tax_percentage'],
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
