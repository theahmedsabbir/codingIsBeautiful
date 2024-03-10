<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $data = [
            'page' => 'index',
            'products' => Product::orderBy('created_at', 'desc')->get()
        ];

        return view('backend.product.index', compact('data'));
    }

    public function create()
    {
        $data = [
            'page' => 'create',
            'products' => Product::orderBy('id', 'desc')->get(),
            'categories' => Category::orderBy('name', 'asc')->where('cat_id', '!=', null)->get(),
            'brands' => Brand::orderBy('name', 'asc')->get(),
        ];

        return view('backend.product.index', compact('data'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'sub_cat_id' => 'required|integer',
            'brand_id' => 'required|integer',
            'price' => 'required',
            'qty' => 'required',
            'short_description' => 'required',
            'long_description' => 'required',
        ]);

        $images = collect();
        if($request->hasfile('images'))
         {
            foreach($request->file('images') as $image)
            {
                $imageName = time(). uniqid().'.'.$image->extension();
                $image->move('products', $imageName);
                $images->push($imageName);
            }
         }

        $product = new Product();
        $product->name = $request->name;
        $product->sub_cat_id = $request->sub_cat_id;
        $product->brand_id = $request->brand_id;
        $product->price = $request->price;
        if($request->discount_price){
           $product->discount_price = $request->discount_price;
        }
        $product->qty = $request->qty;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->images = json_encode($images);
        $product->save();
        return redirect()->back()->withSuccess('Product has been successfully created.');
    }

    public function edit(Product $product)
    {
        $data = [
            'page' => 'edit',
            'product' => $product
        ];

        return view('backend.product.index', compact('data'));
    }

    public function update(Request $request, Product $product)
    {
        $this->validate($request, [
            'name' => 'required',
            'sub_cat_id' => 'required|integer',
            'brand_id' => 'required|integer',
            'price' => 'required',
            'qty' => 'required',
            'short_description' => 'required',
            'long_description' => 'required',
        ]);

        if($request->hasfile('images') && count($request->file('images')) > 0)
         {

            foreach(json_decode($product->images) as $old_image)
            {

                if (file_exists('products/' . $old_image)) {
                    unlink('products/' . $old_image);
                }
            }
            $images = collect();
            foreach($request->file('images') as $image)
            {
                $imageName = time(). uniqid().'.'.$image->extension();
                $image->move('products', $imageName);
                $images->push($imageName);
            }

            $product->images = json_encode($images);
         }

        $product->name = $request->name;
        $product->sub_cat_id = $request->sub_cat_id;
        $product->brand_id = $request->brand_id;
        $product->price = $request->price;
        if($request->discount_price){
           $product->discount_price = $request->discount_price;
        }
        $product->qty = $request->qty;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->save();
        return redirect()->back()->withSuccess('Product has been successfully updated.');
    }

    public function destroy(Product $product)
    {

        foreach(json_decode($product->images) as $old_image)
        {

            if (file_exists('products/' . $old_image)) {
                unlink('products/' . $old_image);
            }
        }
        $product->delete();
        return redirect()->back()->withSuccess('Product has been successfully deleted.');
    }
}
