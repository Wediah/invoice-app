<?php

/** @noinspection PhpUndefinedVariableInspection */

/** @noinspection ALL */

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\CompanyCategory;
use Illuminate\Routing\Redirector;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Cviebrock\EloquentSluggable\Services\SlugService;

class companyController extends Controller
{
    public function create()
    {
       $categories = CompanyCategory::all();
        return view('company.create', compact('categories'));
    }

    public function authCompanyCreate()
    {
       $categories = CompanyCategory::all();
        return view('auth.auth-company-create', compact('categories'));
    }

   

    public function userAndCompany()
    {


        $user = auth()->user();
        $companies = $user->companies()->withCount('invoices')->withCount('catalogs')->get();

        // dd($companies);
        return view('company.index', compact('companies'));
    }

    //starting new company data
    public function store(Request $request): Application|Redirector|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        // dd($request->all());
        $validated = request()->validate([
            'name' => 'required|string|unique:companies,name',
            'email' => 'required|string|unique:companies,email',
            'phone' => 'required|string',
            'country_code' => 'required|string|max:5',
            'phone2' => 'nullable|string',
            'phone2_country_code' => 'nullable|string|max:5',
            'phone3' => 'nullable|string',
            'phone3_country_code' => 'nullable|string|max:5',
            'address' => 'required|string',
            'gps_address' => 'required|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'company_category_id' => 'nullable|integer',
            'description' => 'required|string|max:255',
            'website' => 'required|string',
        ]);

        // Ensure country codes are valid country codes, not phone codes
        if (isset($validated['country_code']) && str_starts_with($validated['country_code'], '+')) {
            $validated['country_code'] = 'GH'; // Default to Ghana
        }
        if (isset($validated['phone2_country_code']) && str_starts_with($validated['phone2_country_code'], '+')) {
            $validated['phone2_country_code'] = 'GH';
        }
        if (isset($validated['phone3_country_code']) && str_starts_with($validated['phone3_country_code'], '+')) {
            $validated['phone3_country_code'] = 'GH';
        }

        // Custom validation for phone numbers and country codes
        if (!empty($validated['phone2_country_code']) && empty($validated['phone2'])) {
            return redirect()->back()->withErrors(['phone2' => 'Phone number is required when country code is selected.'])->withInput();
        }
        
        if (!empty($validated['phone3_country_code']) && empty($validated['phone3'])) {
            return redirect()->back()->withErrors(['phone3' => 'Phone number is required when country code is selected.'])->withInput();
        }
        
        if (!empty($validated['phone2']) && empty($validated['phone2_country_code'])) {
            return redirect()->back()->withErrors(['phone2_country_code' => 'Country code is required when phone number is provided.'])->withInput();
        }
        
        if (!empty($validated['phone3']) && empty($validated['phone3_country_code'])) {
            return redirect()->back()->withErrors(['phone3_country_code' => 'Country code is required when phone number is provided.'])->withInput();
        }

        $companyData = [
            'user_id' => Auth::id(),
            'name' => $validated['name'],
            'slug' => SlugService::createSlug(Company::class, 'slug', request('name')),
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'country_code' => $validated['country_code'],
            'phone2' => !empty($validated['phone2']) ? $validated['phone2'] : null,
            'phone2_country_code' => !empty($validated['phone2']) ? $validated['phone2_country_code'] : null,
            'phone3' => !empty($validated['phone3']) ? $validated['phone3'] : null,
            'phone3_country_code' => !empty($validated['phone3']) ? $validated['phone3_country_code'] : null,
            'address' => $validated['address'],
            'gps_address' => $validated['gps_address'],
            'company_category_id' => $validated['company_category_id'] ?: null,
            'description' => $validated['description'],
            'website' => $validated['website'],
            'logo' => 'apollo-invoice-default-logo.png', // Default logo
        ];

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $filename = uniqid() . '.' . $logo->getClientOriginalExtension();
            $logo->storeAs('public/company_logo', $filename);
            $companyData['logo'] = $filename;
        }
        // If no logo uploaded, keep the default Apollo Invoice logo


        try {
            $company = Company::create($companyData);
            Log::info('Company created successfully', ['company_id' => $company->id, 'user_id' => Auth::id()]);
            return redirect()->intended(route('dashboard', absolute: false));
        } catch (\Exception $e) {
            Log::error('Failed to create company', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->withInput()->with('error', 'Failed to create company. Please try again.');
        }
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

        return redirect()->back()->with('success', 'Advanced information updated successfully!');
    }

    //financial data
    public function financial($slug)
    {
        $company = Company::where('slug', $slug)->first();
        $validated = request()->validate([
            'account_number' => 'sometimes|nullable|string',
            'bank_name' => 'sometimes|nullable|string',
            'bank_branch' => 'sometimes|nullable|string',
            'swift_code' => 'sometimes|nullable|string',
            'merchant_network' => 'sometimes|nullable|string',
            'merchant_number' => 'sometimes|nullable|string',
            'merchant_id' => 'sometimes|nullable|string',
            'merchant_name' => 'sometimes|nullable|string',
            'currency' => 'sometimes|nullable|string',
            'tax_identification_number' => 'sometimes|nullable|string'
        ]);

        $financialData = array(
            'account_number' => $validated['account_number'] ?? $company->account_numer,
            'bank_name' => $validated['bank_name'] ?? $company->bank_details,
            'bank_branch' => $validated['bank_branch'] ?? $company->bank_branch,
            'swift_code' => $validated['swift_code'] ?? $company->swift_code,
            'merchant_network' => $validated['merchant_network'] ?? $company->merchant_network,
            'merchant_number' => $validated['merchant_number'] ?? $company->merchant_number,
            'merchant_id' => $validated['merchant_id'] ?? $company->merchant_id,
            'merchant_name' => $validated['merchant_name'] ?? $company->merchant_name,
            'currency' => $validated['currency'] ?? $company->currency,
            'tax_identification_number' => $validated['tax_identification_number'] ?? $company->tax_identification_number,
        );

        $company->update($financialData);

        return redirect()->back()->with('success', 'Financial information updated successfully!');
    }

    //preference data
    public function preference($slug)
    {
        $company = Company::where('slug', $slug)->first();

        $Data = request()->validate([
            'invoice_prefix' => 'nullable',
            'invoice_numbering' => 'sometimes|nullable|numeric',
            'invoice_footnote' => 'sometimes|nullable|string',
        ]);

        $validatedData = [
            'invoice_prefix' => $Data['invoice_prefix'] ?? $company->invoice_prefix,
            'invoice_numbering' => $Data['invoice_numbering'] ?? $company->invoice_numbering,
            'invoice_footnote' => $Data['invoice_footnote'] ?? $company->invoice_footnote
        ];

        $company->update($validatedData);

        return redirect()->back()->with('success', 'Settings and preferences updated successfully!');
    }

    public function profile($slug): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        $company = Company::where('slug', $slug)->first();
        $categories = companyCategory::all();
        
        // Get profile completion data
        $completionData = $company->getProfileCompletionData();
        
        return view('company.companyProfileForms.index', compact('company', 'categories', 'completionData'));
    }

    // public function update(Request $request,$slug): RedirectResponse
    // {
    //     $company = Company::where('slug', $slug)->first();

    //     $validatedData = request()->validate([
    //         'name' => 'sometimes|nullable|string',
    //         'email' => 'sometimes|nullable|string',
    //         'phone' => 'sometimes|nullable|string',
    //         'address' => 'sometimes|nullable|string',
    //         'logo' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //         'category' => 'sometimes|nullable|string',
    //     ]);

    //     $updateData = [
    //         'user_id' => Auth::id(),
    //         'name' => $validatedData['name'] ?? $company->name,
    //         'slug' => $company->name == $validatedData['name'] ? $company->slug : SlugService::createSlug
    //         (Company::class,
    //             'slug',$validatedData['name']),
    //         'email' => $validatedData['email'] ?? $company->email,
    //         'phone' => $validatedData['phone'] ?? $company->phone,
    //         'address' => $validatedData['address'] ?? $company->address,
    //         'company_category_id' => $validatedData['category'] ?? $company->category,
    //     ];

    //     if($request->hasFile('logo')){
    //         $logo = $request->file('logo');
    //         $filename = uniqid() . '.' . $logo->getClientOriginalExtension();
    //         $logo -> storeAs('public/company_logo', $filename);
    //         $updateData['logo'] = $filename;
    //     }

    //     $company->update($updateData);

    //     // return redirect()->back()->with('company', $company->fresh());
    //     return redirect()->route('dashboard', $company->slug);

    // }

    public function update(Request $request, $slug): RedirectResponse
    {
        $company = Company::where('slug', $slug)->firstOrFail();

        $validatedData = $request->validate([
            'name' => 'sometimes|nullable|string|max:255',
            'email' => 'sometimes|nullable|email|max:255',
            'phone' => 'sometimes|nullable|string|max:20',
            'country_code' => 'sometimes|nullable|string|max:5',
            'phone2' => 'sometimes|nullable|string|max:20',
            'phone2_country_code' => 'sometimes|nullable|string|max:5',
            'phone3' => 'sometimes|nullable|string|max:20',
            'phone3_country_code' => 'sometimes|nullable|string|max:5',
            'address' => 'sometimes|nullable|string|max:255',
            'logo' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category' => 'sometimes|nullable|exists:company_categories,id',
        ]);

        // Custom validation for phone numbers and country codes
        if (!empty($validatedData['phone2_country_code']) && empty($validatedData['phone2'])) {
            return redirect()->back()->withErrors(['phone2' => 'Phone number is required when country code is selected.'])->withInput();
        }
        
        if (!empty($validatedData['phone3_country_code']) && empty($validatedData['phone3'])) {
            return redirect()->back()->withErrors(['phone3' => 'Phone number is required when country code is selected.'])->withInput();
        }
        
        if (!empty($validatedData['phone2']) && empty($validatedData['phone2_country_code'])) {
            return redirect()->back()->withErrors(['phone2_country_code' => 'Country code is required when phone number is provided.'])->withInput();
        }
        
        if (!empty($validatedData['phone3']) && empty($validatedData['phone3_country_code'])) {
            return redirect()->back()->withErrors(['phone3_country_code' => 'Country code is required when phone number is provided.'])->withInput();
        }

        $updateData = [
            'user_id' => Auth::id(),
            'name' => $validatedData['name'] ?? $company->name,
            'email' => $validatedData['email'] ?? $company->email,
            'phone' => $validatedData['phone'] ?? $company->phone,
            'country_code' => $validatedData['country_code'] ?? $company->country_code,
            'phone2' => !empty($validatedData['phone2']) ? $validatedData['phone2'] : null,
            'phone2_country_code' => !empty($validatedData['phone2']) ? $validatedData['phone2_country_code'] : null,
            'phone3' => !empty($validatedData['phone3']) ? $validatedData['phone3'] : null,
            'phone3_country_code' => !empty($validatedData['phone3']) ? $validatedData['phone3_country_code'] : null,
            'address' => $validatedData['address'] ?? $company->address,
            'company_category_id' => $validatedData['category'] ?? $company->company_category_id,
        ];



        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $filename = uniqid() . '.' . $logo->getClientOriginalExtension();
            $logo->storeAs('public/company_logo', $filename);

            // Delete old logo if exists
            if ($company->logo) {
                Storage::delete('public/company_logo/' . $company->logo);
            }

            $updateData['logo'] = $filename;
        }

        try {
            $company->update($updateData);
            Log::info('Company updated successfully', ['company_id' => $company->id, 'user_id' => Auth::id()]);
            return redirect()->back()->with('success', 'Basic information updated successfully!');
        } catch (\Exception $e) {
            Log::error('Failed to update company', [
                'company_id' => $company->id,
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->withInput()->with('error', 'Failed to update company. Please try again.');
        }
    }




    public function delete(string $id)
    {
        $deleteCompany = Company::findOrFail($id);

        $deleteCompany->delete();
        usleep(500000);
        return redirect()->intended(route('dashboard', absolute: false));
    }
}
