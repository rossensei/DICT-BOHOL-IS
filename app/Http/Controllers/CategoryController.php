<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categories = Category::select('id', 'catname')
            ->with('subcategories:id,category_id,subcatname')
            ->get();

        return inertia('Category/Index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'catname' => 'required|string|unique:categories'
        ], [
            'catname.required' => 'The category name field is required.',
            'catname.unique' => 'The category name is already taken.',
        ]);

        Category::create($request->all());

        return back()->with('success', 'Category successfully created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return inertia('Category/Edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'catname' => ['required', 'string', Rule::unique(Category::class)->ignore($category->id)],
        ], [
            'catname.required' => 'The category name field is required.',
        ]);

        $category->update($request->all());

        return back()->with('success', 'Category details successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if($category->subCategories()->exists()) {
            return back()->with('error', 'Category cannot be deleted because it has existing subcategories.');
        } else {
            $category->delete();
            return back()->with('success', 'Category has been removed.');
        }
    }
}
