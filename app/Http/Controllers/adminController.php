<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class adminController extends Controller
{
    public function showCategory(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        return view('category.create');
    }

    public function storeCategory(Request $request)
    {
        $attributes = request()->validate([
            'slug' => SlugService::createSlug(category::class, 'slug', request('name')),
            'name' => request('name'),
        ]);

        Category::firstOrCreate($attributes);

        return redirect('/');
    }

    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('category.edit', compact('category'));
    }

    public function update(Request $request, string $id)
    {
        $update = Category::findOrFail($id);

        $update->update(request()->validate([
            'slug' => SlugService::createSlug(category::class, 'slug', request('name')),
            'name' => request('name'),
        ]));

        return redirect('/');
    }

    public function delete(string $id)
    {
        $delete = Category::findOrFail($id);

        $delete->delete();

        return redirect('/');
    }
}
