<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function all(Request $request)
    {
    	$products = Product::paginate(12);
    	if (count($request->all()) > 0) {
            // return $request->all();


            // orderBy
            if ($request->filled('orderBy') && $request->orderBy != 'default' ) {       
                $productQuery->orderBy('id', $request->orderBy);
            }else{
                $productQuery = Product::orderBy('id', 'desc');
            }


            // search
            if ($request->filled('search')) {
                $search = '%' . $request->search . '%';
                $productQuery->where('name', 'like' ,$search)
                            ->orWhere('short_description', 'like' ,$search)
                            ->orWhere('long_description', 'like' ,$search)
                            ->orWhereHas('category', function($category) use($search){
                                $category->where('name', 'like' , $search);
                            })
                            ->orWhereHas('brand', function($brand) use($search){
                                $brand->where('name', 'like' , $search);
                            });
            }


            // price
            if ($request->filled('min') && $request->filled('max')) {
                
                $productQuery->where('price', '>=', $request->min)
                        ->where('price', '<=', $request->max);
            }

            // cat ids
    		if ($request->filled('cat_ids')) {	    			
	    		$productQuery->whereIn('sub_cat_id', $request->cat_ids);
    		}

            // brand ids
    		if ($request->filled('brand_ids')) {	    			
	    		$productQuery->whereIn('brand_id', $request->brand_ids);
    		}    			
    		

    		$products = $productQuery->paginate(12);
    	}
        return view('frontend.product.all', compact('products'));
    }

    public function details($id){
        if($product = Product::where('id', $id)->first()) { return view('frontend.product.details', compact('product')); }
        else { return redirect()->back()->with('Error', 'Product not found');}
        
    }
}
