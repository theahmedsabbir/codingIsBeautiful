<?php

namespace App\Http\Controllers\Backend;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $data = [
            'page' => 'index',
            'categories' => Category::orderBy('name', 'asc')->get()
        ];

        return view('backend.category.index', compact('data'));
    }

    public function create()
    {
        $data = [
            'page' => 'create',
        ];

        return view('backend.category.index', compact('data'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:categories,name',
        ]);

        $lastCategory = Category::orderBy('priority')->first();

        $category = new Category();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->icon = $request->icon;
        $category->priority = $lastCategory ? $lastCategory->priority + 1 : 1;
        $category->status = $request->status;
        $category->save();

        return redirect()->back()->withSuccess('Category has been successfully created.');
    }

    public function edit(Category $category)
    {
        $data = [
            'page' => 'edit',
            'category' => $category
        ];

        return view('backend.category.index', compact('data'));
    }

    public function update(Request $request, Category $category)
    {
        // create validation for unique category slug
        $this->validate($request, [
            'name' => 'required|unique:categories,name,' . $category->id,
        ]);

        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->icon = $request->icon;
        $category->priority = $request->priority;
        $category->status = $request->status;
        $category->save();
        return redirect()->back()->withSuccess('Category has been successfully updated.');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->back()->withSuccess('Category has been successfully deleted.');
    }
}
