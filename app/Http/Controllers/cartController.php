<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class cartController extends Controller
{
    public function addToCart(Request $request, $slug)
    {
        $user_id = Auth::id();

        $company = Company::where('slug', $slug)->firstOrFail();
        $company_id = $company->id;


        $validatedData = request()->validate([
            'catalog_id' => 'required|exists:catalogs,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $cartData = array(
            'user_id' => $user_id,
            'company_id' => $company_id,
            'catalog_id' => $validatedData['catalog_id'],
            'quantity' => $validatedData['quantity']
        );

        cart::create($cartData);

        return redirect()->back();
    }

    public function delete(string $id)
    {
        $clearCart = cart::findOrFail($id);
        $clearCart->delete();
        return redirect()->back();
    }
}
