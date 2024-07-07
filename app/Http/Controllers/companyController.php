<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Company;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class companyController extends Controller
{
    public function create()
    {
//        $categories = Category::all();
//        return view('company.create', compact('categories'));
        return view('company.create');
    }

    public function userAndCompany()
    {
        $user = Auth::user();
        $companies = $user->companies;

        return view('company.index', compact('companies'));
    }

    public function store(Request $request): Application|Redirector|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        $validated = request()->validate([
            'name' => 'required|string|unique:companies,name',
            'email' => 'required|string|unique:companies,email',
            'phone' => 'required|string|unique:companies,phone',
            'address' => 'required|string',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|string',
            'category' => 'required|string',
        ]);

        $companyData = [
            'user_id' => Auth::id(),
            'name' => $validated['name'],
            'slug' => SlugService::createSlug(Company::class, 'slug', request('name')),
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'description' => $validated['description'],
            'category' => $validated['category'],
        ];

        if($request->hasFile('logo')){
            $logo = $request->file('logo');
            $filename = uniqid() . '.' . $logo->getClientOriginalExtension();
            $logo -> storeAs('public/company_logo', $filename);
            $companyData['logo'] = $filename;
        }

        Company::firstOrCreate($companyData);

        return redirect()->intended(route('company.user', absolute: false));
    }

    public function edit(string $id)
    {
        $company = Company::findOrFail($id);
        return view('company.edit', compact('company'));
    }

    public function update(Request $request,string $id)
    {
        $updateCompany = Company::findOrFail($id);

        $validatedData = request()->validate([
            'name' => 'sometimes|nullable|string|unique:companies,name',
            'email' => 'sometimes|nullable|string|unique:companies,email',
            'phone' => 'sometimes|nullable|string|unique:companies,phone',
            'address' => 'sometimes|nullable|string',
            'logo' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'sometimes|nullable|string',
            'category' => 'sometimes|nullable|string',
//            'other_category' => 'sometimes|nullable|string'
        ]);

        $updateData = [
            'user_id' => Auth::id(),
            'name' => $validatedData['name'] ?? $updateCompany->name,
            'slug' => SlugService::createSlug(Company::class, 'slug', $validatedData['name']),
            'email' => $validatedData['email'] ?? $updateCompany->email,
            'phone' => $validatedData['phone'] ?? $updateCompany->phone,
            'address' => $validatedData['address'] ?? $updateCompany->address,
            'description' => $validatedData['description'] ?? $updateCompany->description,
            'category' => $validatedData['category'] ?? $updateCompany->category,
//            'other_category' => $validatedData['other_category'] ?? $updateCompany->other_category
        ];

        if($request->hasFile('logo')){
            $logo = $request->file('logo');
            $filename = uniqid() . '.' . $logo->getClientOriginalExtension();
            $logo -> storeAs('public/company_logo', $filename);
            $updateData['logo'] = $filename;
        }

        $updateCompany->update($updateData);

        return redirect()->intended(route('company.user', absolute: false));
    }

    public function delete(string $id)
    {
        $deleteCompany = Company::findOrFail($id);

        $deleteCompany->delete();

        return redirect()->intended(route('company.user', absolute: false));
    }

    public function show($slug)
    {
        $company = Company::where('slug', $slug)->firstOrFail();
        $companyCatalog = $company->catalogs;
        $user = Auth::user();
        return view('company.show', compact('company', 'companyCatalog', 'user'));
    }
}
