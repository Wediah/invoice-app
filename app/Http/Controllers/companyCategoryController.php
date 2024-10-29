<?php

namespace App\Http\Controllers;

use App\Models\CompanyCategory;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;

class companyCategoryController extends Controller
{
    public function create()
    {
        return view('company.companyCategory.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:company_categories|max:255',
        ]);

        $validatedData = [
            'name' => $validated['name'],
            'slug' => SlugService::createSlug(CompanyCategory::class, 'slug', request('name'))
        ];

        CompanyCategory::firstOrCreate($validatedData);

        return redirect()->back();
    }

    public function edit($id)
    {
        $category = CompanyCategory::where('id', $id)->firstOrFail();
        return view('company.companyCategory.edit', compact('category'));
    }

    public function update($id, Request $request)
    {
        $category = CompanyCategory::where('id', $id)->firstOrFail();

        $validated = $request->validate([
            'name' => 'sometimes|string'
        ]);

        $updateData = [
            'name' => $validated['name'],
            'slug' => $category->name == $validated['name'] ? $category->slug : SlugService::createSlug
            (CompanyCategory::class, 'slug', request('name')),
        ];

        $category->update($updateData);
    }

    public function delete($id)
    {
        $category = CompanyCategory::where('id', $id)->firstOrFail();
        $category->delete();
        usleep(500000);
        return redirect()->back();
    }
}
