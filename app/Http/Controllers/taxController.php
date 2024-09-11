<?php

namespace App\Http\Controllers;

use App\Models\Tax;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class taxController extends Controller
{
    public function index($slug)
    {
        $company = Company::where('slug', $slug)->firstOrFail();
        $taxes = $company->taxes;

        return view('tax.index', compact('taxes', 'company'));
    }

    public function allPrimaryTax($slug)
    {
        $company = Company::where('slug', $slug)->with('taxes')->firstOrFail();
        $primaryTaxes = $company->taxes()->where('type', 'PRIMARY');

        return view('tax.primary', compact('primaryTaxes', 'company'));
    }

    public function allSecondaryTax($slug)
    {
        $company = Company::where('slug', $slug)->with('taxes')->firstOrFail();
        $secondaryTaxes = $company->taxes()->where('type', 'SECONDARY');

        return view('tax.secondary', compact('secondaryTaxes', 'company'));
    }

    public function create($slug)
    {
        $company = Company::where('slug', $slug)->firstOrFail();

        return view('tax.create', compact('company'));
    }

    public function store($slug, Request $request)
    {
        $data = $request->group_a;
        // dd($data);

        foreach ($data as $key => $validata) {

            $validator = Validator::make(
                $validata,

                [
                    'tax_name' => 'required|string|max:255',
                    'tax_percentage' => 'required|numeric|between:0,100',
                    'tax_type' => 'required|string|in:primary,secondary',

                ]
            );
            if ($validator->fails()) {
                // dd($validator);
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        $company = Company::where('slug', $slug)->firstOrFail();
        $company_id = $company->id;

        foreach ($data as $prop) {
            $tax_name = $prop['tax_name'];
            $tax_percentage = $prop['tax_percentage'];
            $tax_type = $prop['tax_type'];


            $taxData = new Tax();
            $taxData->company_id = $company_id;
            $taxData->tax_name = $tax_name;
            $taxData->tax_percentage = $tax_percentage;
            $taxData->type = $tax_type;
            $taxData->save();



        }


        return redirect()->back()->with('success', 'Tax added successfully!');
    }

    public function edit($slug, $id)
    {
        $company = Company::where('slug', $slug)->firstOrFail();
        $tax = Tax::where('id', $id)
            ->where('company_id', $company->id)
            ->firstOrFail();

        return view('tax.edit', compact('tax', 'company'));
    }

    public function update($slug, $id)
    {
        $company = Company::where('slug', $slug)->firstOrFail();
        $tax = Tax::where('id', $id)
                    ->where('company_id', $company->id)
                    ->firstOrFail();

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

        return redirect()->back()->with('success', 'Tax updated successfully.');
    }

    public function destroy($slug, $id): RedirectResponse
    {
        $company = Company::where('slug', $slug)->firstOrFail();
        $tax = Tax::where('id', $id)
            ->where('company_id', $company->id)
            ->firstOrFail();

        $tax->delete();

        return redirect()->back()->with('success', 'Tax deleted successfully.');
    }
}
