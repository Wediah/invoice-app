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
                    'stock_description' => 'required|string|min:5|max:300',
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


            $stockData = new Catalog();
            $stockData->company_id = $company_id;
            $stockData->name = $stock_name;
            $stockData->description = $stock_description;
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

        $company = Company::where('slug', $slug)->firstOrFail();
        $catalog = Catalog::where('id', $id)
            ->where('company_id', $company->id)
            ->firstOrFail();
        $company_id = $catalog->company_id;

        $validatedData = $request->validate([
            'stock_name' => 'sometimes|max:255|string',
            'stock_description' => 'sometimes|string|min:5|max:300',
            'stock_price' => 'sometimes|string',
            //            'catalog_images.*' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        //        $imagePaths = [];
        //        foreach ($validatedData['catalog_images'] as $key => $image) {
        //            $imageName = Carbon::now()->timestamp . $key . '.' . $image->extension();
        //            $image->storeAs('catalogImages', $imageName);
        //            $imagePaths[] = $imageName;
        //        }

        $catalogData = array(
            'company_id' => $company_id,
            'name' => $validatedData['stock_name'] ?? $catalog->name,
            'description' => $validatedData['stock_description'] ?? $catalog->description,
            'price' => $validatedData['stock_price'] ?? $catalog->price,
        );

        $catalog->update($catalogData);

        //        foreach ($imagePaths as $imagePath) {
        //            catalogImage::create([
        //                'catalog_id' => $catalog->id,
        //                'image_path' => $imagePath,
        //            ]);
        //        }

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
