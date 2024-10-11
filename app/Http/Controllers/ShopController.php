<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function shop_index(){

        $products=Product::orderBy('created_at','DESC')->paginate(12);
        return view('shop',compact('products'));
    }//End Method

    public function product_detail($product_slug){
        $product =Product::where('slug', $product_slug)->first();
        return view('details',compact('product'));
    }

}
