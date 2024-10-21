<?php /** @noinspection PhpUndefinedVariableInspection */

/** @noinspection ALL */

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Company;
use App\Models\companyCategory;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class companyController extends Controller
{
    public function create()
    {
        $categories = companyCategory::all();
        return view('company.create', compact('categories'));
    }

    public function authCompanyCreate()
    {
        $categories = companyCategory::all();
        return view('auth.auth-company-create', compact('categories'));
    }

    // public function userAndCompany()
    // {
    //     $user = Auth::user();
    //     $companies = $user->companies()->with('companyCategory')->withCount('invoices', 'catalogs')->get();

    //     return view('company.index', compact('companies'));
    // }

    public function userAndCompany()
    {
        $user = auth()->user();
        $companies = $user->companies()->withCount('invoices')->withCount('catalogs')->get();
        return view('company.index', compact('companies'));
    }

    //starting new company data
    public function store(Request $request): Application|Redirector|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        $validated = request()->validate([
            'name' => 'required|string|unique:companies,name',
            'email' => 'required|string|unique:companies,email',
            'phone' => 'required|string',
            'address' => 'required|string',
            'gps_address' => 'required|string',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category' => 'sometimes|nullable|string',
            'description' => 'required|string|max:255',
            'website' => 'required|string',
        ]);

        $companyData = [
            'user_id' => Auth::id(),
            'name' => $validated['name'],
            'slug' => SlugService::createSlug(Company::class, 'slug', request('name')),
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'gps_address' => $validated['gps_address'],
            // 'company_category_id' => $validated['category'],
            'description' => $validated['description'],
            'website' => $validated['website'],
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

        return redirect()->back();
    }

    //preference data
    public function preference($slug)
    {
        $company = Company::where('slug', $slug)->first();

        $Data = request()->validate([
            'invoice_prefix' => 'nullable',
            'invoice_numbering' => 'sometimes|nullable|numeric',
        ]);

        $validatedData = [
            'invoice_prefix' => $Data['invoice_prefix'] ?? $company->invoice_prefix,
            'invoice_numbering' => $Data['invoice_numbering'] ?? $company->invoice_numbering,
        ];

        $company->update($validatedData);

        return redirect()->back();
    }

    public function profile($slug): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        $company = Company::where('slug', $slug)->first();
        $categories = companyCategory::all();
        return view('company.companyProfileForms.index', compact('company','categories'));
    }

    public function update(Request $request,$slug): RedirectResponse
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
            'slug' => $company->name == $validatedData['name'] ? $company->slug : SlugService::createSlug
            (Company::class,
                'slug',
                    $validatedData['name']),
            'email' => $validatedData['email'] ?? $company->email,
            'phone' => $validatedData['phone'] ?? $company->phone,
            'address' => $validatedData['address'] ?? $company->address,
            'company_category_id' => $validatedData['category'] ?? $company->category,
//            'other_category' => $validatedData['other_category'] ?? $updateCompany->other_category
        ];

        if($request->hasFile('logo')){
            $logo = $request->file('logo');
            $filename = uniqid() . '.' . $logo->getClientOriginalExtension();
            $logo -> storeAs('public/company_logo', $filename);
            $updateData['logo'] = $filename;
        }

        $company->update($updateData);

        return redirect()->back();
    }

    public function delete(string $id)
    {
        $deleteCompany = Company::findOrFail($id);

        $deleteCompany->delete();
        usleep(500000);
        return redirect()->intended(route('dashboard', absolute: false));
    }
}
