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

    //starting new company data
    public function store(Request $request): Application|Redirector|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        $validated = request()->validate([
            'name' => 'required|string|unique:companies,name',
            'email' => 'required|string|unique:companies,email',
            'phone' => 'required|string|unique:companies,phone',
            'address' => 'required|string',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category' => 'required|string',
        ]);

        $companyData = [
            'user_id' => Auth::id(),
            'name' => $validated['name'],
            'slug' => SlugService::createSlug(Company::class, 'slug', request('name')),
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'category' => $validated['category'],
        ];

        if($request->hasFile('logo')){
            $logo = $request->file('logo');
            $filename = uniqid() . '.' . $logo->getClientOriginalExtension();
            $logo -> storeAs('public/company_logo', $filename);
            $companyData['logo'] = $filename;
        }

        Company::firstOrCreate($companyData);

        return redirect()->intended(route('dashboard', absolute: false));
    }

    //company info
    public function info($slug)
    {
        $company = Company::where('slug', $slug)->first();

        $attributes = request()->validate([
            'registration_number' => 'sometimes|nullable|string',
            'description' => 'sometimes|nullable|string',
            'website' => 'sometimes|nullable|string',
            'instagram' => 'sometimes|nullable|string',
            'facebook' => 'sometimes|nullable|string',
            'twitter' => 'sometimes|nullable|string',
            'tiktok' => 'sometimes|nullable|string',
            'linkedin' => 'sometimes|nullable|string',
        ]);

        $validatedAttributes = [
            'registration_number' => $attributes['registration_number'] ?? $company->registration_number,
            'description' => $attributes['description'] ?? $company->description,
            'website' => $attributes['website'] ?? $company->website,
            'instagram' => $attributes['instagram'] ?? $company->instagram,
            'facebook' => $attributes['facebook'] ?? $company->facebook,
            'twitter' => $attributes['twitter'] ?? $company->twitter,
            'tiktok' => $attributes['tiktok'] ?? $company->tiktok,
            'linkedin' => $attributes['linkedin'] ?? $company->linkedin,
        ];

        $company->update($validatedAttributes);

        return redirect()->back();
    }

    //financial data
    public function financial($slug)
    {
        $company = Company::where('slug', $slug)->first();
        $validated = request()->validate([
            'bank_details' => 'string',
            'currency' => 'string',
            'tax_identification_number' => 'string'
        ]);

        $financialData = array(
            'bank_details' => $validated['bank_details'] ?? $company->bank_details,
            'currency' => $validated['currency'] ?? $company->currency,
            'tax_identification_number' => $validated['tax_identification_number'] ?? $company->tax_identification_number,
        );

        $company->update($financialData);

        return redirect()->back();
    }

    //preference data
    public function preference($slug)
    {
        $company = Company::where('slug', $slug)->first();

        $Data = request()->validate([
            'invoice_prefix' => 'string',
            'invoice_numbering' => 'string|min:2'
        ]);

        $validatedData = [
            'invoice_prefix' => $Data['invoice_prefix'] ?? $company->invoice_prefix,
            'invoice_numbering' => $Data['invoice_numbering'] ?? $company->invoice_numbering,
        ];

        $company->update($validatedData);

        return redirect()->back();
    }

    public function profile($slug)
    {
        $company = Company::where('slug', $slug)->first();
        return view('businessProfile.index', compact('company'));
    }


//    public function edit(string $id)
//    {
//        $company = Company::findOrFail($id);
//        return view('company.edit', compact('company'));
//    }

    public function update(Request $request,$slug)
    {
        $company = Company::where('slug', $slug)->first();

        $validatedData = request()->validate([
            'name' => 'sometimes|nullable|string',
            'email' => 'sometimes|nullable|string',
            'phone' => 'sometimes|nullable|string',
            'address' => 'sometimes|nullable|string',
            'logo' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category' => 'sometimes|nullable|string',
//            'other_category' => 'sometimes|nullable|string'
        ]);

        $updateData = [
            'user_id' => Auth::id(),
            'name' => $validatedData['name'] ?? $company->name,
            'slug' => SlugService::createSlug(Company::class, 'slug', $validatedData['name']),
            'email' => $validatedData['email'] ?? $company->email,
            'phone' => $validatedData['phone'] ?? $company->phone,
            'address' => $validatedData['address'] ?? $company->address,
            'category' => $validatedData['category'] ?? $company->category,
//            'other_category' => $validatedData['other_category'] ?? $updateCompany->other_category
        ];

        if($request->hasFile('logo')){
            $logo = $request->file('logo');
            $filename = uniqid() . '.' . $logo->getClientOriginalExtension();
            $logo -> storeAs('public/company_logo', $filename);
            $updateData['logo'] = $filename;
        }

        $company->update($updateData);

        return redirect()->intended(route('dashboard', absolute: false));
    }

    public function delete(string $id)
    {
        $deleteCompany = Company::findOrFail($id);

        $deleteCompany->delete();

        return redirect()->intended(route('dashboard', absolute: false));
    }

    public function show($slug)
    {
        $company = Company::where('slug', $slug)->firstOrFail();
        $companyCatalog = $company->catalogs;
        $user = Auth::user();
        return view('company.show', compact('company', 'companyCatalog', 'user'));
    }
}
