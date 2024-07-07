<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Models\catalogImage;
use App\Models\Company;
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
            'catalog_images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $company_id = $company->id;

       $imagePaths = [];
        foreach ($validatedData['catalog_images'] as $key => $image) {
            $imageName = Carbon::now()->timestamp . $key . '.' . $image->extension();
            $image->storeAs('catalogImages', $imageName);
            $imagePaths[] = $imageName;
       }

        $catalogData = array(
            'company_id' => $company_id,
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
        );

        $catalog = Catalog::create($catalogData);

        foreach ($imagePaths as $imagePath) {
            catalogImage::create([
                'catalog_id' => $catalog->id,
                'image_path' => $imagePath,
            ]);
        }

        return redirect()->intended(route('company.show',['slug' => $company->slug], absolute: false));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
