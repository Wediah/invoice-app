<?php

namespace App\Http\Controllers;

use App\itemStatus;
use App\Models\Catalog;
use App\Models\catalogImage;
use App\Models\Company;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class catalogController extends Controller
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
    public function create($id)
    {
        $company = Company::findOrFail($id);
        return view('catalog.create', compact('company'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(string $id, Request $request)
    {
        $company = Company::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|max:255|string',
            'description' => 'required|string|min:5|max:300',
            'price' => 'required|string',
//            'catalog_images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $company_id = $company->id;

//       $imagePaths = [];
//        foreach ($validatedData['catalog_images'] as $key => $image) {
//            $imageName = Carbon::now()->timestamp . $key . '.' . $image->extension();
//            $image->storeAs('catalogImages', $imageName);
//            $imagePaths[] = $imageName;
//       }

        $catalogData = array(
            'company_id' => $company_id,
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
        );

        $catalog = Catalog::create($catalogData);

//        foreach ($imagePaths as $imagePath) {
//            catalogImage::create([
//                'catalog_id' => $catalog->id,
//                'image_path' => $imagePath,
//            ]);
//        }

        return redirect()->intended(route('catalog.show',['slug' => $company->slug], absolute: false));
    }

    /**
     * Display the specified resource.
     */

    public function show($slug)
    {
        $company = Company::where('slug', $slug)->firstOrFail();
        $companyCatalog = $company->catalogs;
        $user = Auth::user();
        return view('catalog.show', compact('company', 'companyCatalog', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug, $id): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        $company = Company::where('slug', $slug)->firstOrFail();

        $catalog = Catalog::where('id', $id)
                            ->where('company_id', $company->id)
                            ->firstOrFail();


        return view('catalog.edit', compact('catalog', 'company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$slug, $id): RedirectResponse
    {
        $company = Company::where('slug', $slug)->firstOrFail();
        $catalog = Catalog::where('id', $id)
                            ->where('company_id', $company->id)
                            ->firstOrFail();
        $company_id = $catalog->company_id;

        $validatedData = $request->validate([
            'name' => 'sometimes|max:255|string',
            'description' => 'sometimes|string|min:5|max:300',
            'price' => 'sometimes|string',
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
            'name' => $validatedData['name'] ?? $catalog->name,
            'description' => $validatedData['description'] ?? $catalog->description,
            'price' => $validatedData['price'] ?? $catalog->price,
        );

        $catalog->update($catalogData);

//        foreach ($imagePaths as $imagePath) {
//            catalogImage::create([
//                'catalog_id' => $catalog->id,
//                'image_path' => $imagePath,
//            ]);
//        }

        return redirect()->back()->with('success', 'catalog updated successfully');
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

        return redirect()->back();
    }

    public function outstock($slug, $id): RedirectResponse
    {
        $company = Company::where('slug', $slug)->firstOrFail();
        $catalog = Catalog::where('id', $id)
            ->where('company_id', $company->id)
            ->firstOrFail();

        $catalog->status = itemStatus::OUTOFSTOCK->value;

        return redirect()->back();
    }
}
