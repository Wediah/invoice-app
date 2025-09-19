<?php

namespace App\Http\Controllers;

use App\itemStatus;
use App\Models\Catalog;
use App\Models\Company;
use App\Models\catalogImage;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Validator;

class catalogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($slug)
    {
        $company = Company::where('slug', $slug)->firstOrFail();
        $companyCatalog = $company->catalogs;
        $user = Auth::user();
        return view('company.catalog.index', compact('company', 'companyCatalog', 'user'));
    }

    public function catalogInstock($slug)
    {
        $company = Company::where('slug', $slug)->firstOrFail();
        $companyCatalogInstock = $company->catalogs->where('status', 'instock');
        $user = Auth::user();
        return view('company.catalog.instock', compact('company', 'companyCatalogInstock', 'user'));
    }

    public function catalogOutofstock($slug)
    {
        $company = Company::where('slug', $slug)->firstOrFail();
        $companyCatalogOutofstock = $company->catalogs->where('status', 'outofstock');
        $user = Auth::user();
        return view('company.catalog.outofstock', compact('company', 'companyCatalogOutofstock', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $company = Company::findOrFail($id);
        return view('company.catalog.create', compact('company'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(string $id, Request $request)
    {
        $data = $request->group_a;


        foreach ($data as $key => $validata) {

            $validator = Validator::make(
                $validata,

                [
                    'stock_name' => 'required|max:255|string',
                    'stock_description' => 'sometimes|nullable|min:5|max:300',
                    'unit_of_measurement' => 'required|max:255|string',
                    'stock_price' => 'required|string',

                ]
            );
            if ($validator->fails()) {
                // dd($validator);
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
        }


        $company = Company::findOrFail($id);

        $company_id = $company->id;


        foreach ($data as $prop) {
            $stock_name = $prop['stock_name'];
            $stock_price = $prop['stock_price'];
            $stock_description = $prop['stock_description'];
            $unit_of_measurement = $prop['unit_of_measurement'];


            $stockData = new Catalog();
            $stockData->company_id = $company_id;
            $stockData->name = $stock_name;
            $stockData->description = $stock_description;
            $stockData->unit_of_measurement = $unit_of_measurement;
            $stockData->price = $stock_price;
            $stockData->save();
        }

        return redirect()->intended(route('catalog.index', ['slug' => $company->slug], absolute: false));
    }

    /**
     * Display the specified resource.
     */

    public function show($slug) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug, $id): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {

        $company = Company::where('slug', $slug)->firstOrFail();

        $catalog = Catalog::where('id', $id)->where('company_id', $company->id)->firstOrFail();


        return view('company.catalog.edit', compact('catalog', 'company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slug, $id): RedirectResponse
    {
        // Validate incoming data. Use nullable fields to allow partial updates.
        $validatedData = $request->validate([
            'stock_name' => 'sometimes|required|max:255|string',
            'stock_description' => 'sometimes|nullable|string|min:5|max:300',
            'unit_of_measurement' => 'sometimes|nullable|max:255|string',
            'stock_price' => 'sometimes|nullable|numeric',
        ]);

        $company = Company::where('slug', $slug)->firstOrFail();
        $catalog = Catalog::where('id', $id)
            ->where('company_id', $company->id)
            ->firstOrFail();

     


        // Build update data only for fields provided by the request.
        $catalogData = [];

        if (array_key_exists('stock_name', $validatedData)) {
            $catalogData['name'] = $validatedData['stock_name'];
        }

        if (array_key_exists('stock_description', $validatedData)) {
            $catalogData['description'] = $validatedData['stock_description'];
        }

        if (array_key_exists('unit_of_measurement', $validatedData)) {
            $catalogData['unit_of_measurement'] = $validatedData['unit_of_measurement'];
        }

        if (array_key_exists('stock_price', $validatedData)) {
            $catalogData['price'] = $validatedData['stock_price'];
        }

        // Normally company_id should not change here, but if the catalog's company differs from the route company,
        // you can optionally ensure consistency. This only sets company_id if different.
        if (!empty($company->id) && $company->id !== $catalog->company_id) {
            $catalogData['company_id'] = $company->id;
        }

        // Perform update only when there's something to update.
        if (!empty($catalogData)) {
            $catalog->update($catalogData);
            session()->flash('success', 'Catalog updated successfully.');
        } else {
            // No changes were provided; optionally set an info message.
            session()->flash('info', 'No changes detected.');
        }

        return redirect()->intended(route('catalog.index', ['slug' => $company->slug], absolute: false));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug, $id)
    {
        $company = Company::where('slug', $slug)->firstOrFail();
        $catalog = Catalog::where('id', $id)
            ->where('company_id', $company->id)
            ->firstOrFail();

        $catalog->delete();

        usleep(500000);

        return redirect()->back();
    }

    public function instock($slug, $id): RedirectResponse
    {
        $company = Company::where('slug', $slug)->firstOrFail();
        $catalog = Catalog::where('id', $id)
            ->where('company_id', $company->id)
            ->firstOrFail();

        $catalog->status = itemStatus::INSTOCK->value;
        $catalog->save();

        return redirect()->back();
    }

    public function outstock($slug, $id): RedirectResponse
    {
        $company = Company::where('slug', $slug)->firstOrFail();
        $catalog = Catalog::where('id', $id)
            ->where('company_id', $company->id)
            ->firstOrFail();

        $catalog->status = itemStatus::OUTOFSTOCK->value;
        $catalog->save();

        return redirect()->back();
    }

    public function limitedstock($slug, $id): RedirectResponse
    {
        $company = Company::where('slug', $slug)->firstOrFail();
        $catalog = Catalog::where('id', $id)
            ->where('company_id', $company->id)
            ->firstOrFail();

        $catalog->status = itemStatus::LIMITED->value;
        $catalog->save();

        return redirect()->back();
    }
}
