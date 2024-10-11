<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Surfsidemedia\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function index(){
        $items=Cart::instance('cart')->content();
        return view('cart',compact('items'));
    }//End Method

    public function add_to_cart(Request $request){
        Cart::instance('cart')->add($request->id,$request->name,$request->quantity,$request->price)->associate('App\Models\Product');
        return redirect()->back();
    }//End Method

    public function increase_cart_qty($rowId){
        $product=Cart::instance('cart')->get($rowId);
        $qty=$product->qty + 1;
        Cart::instance('cart')->update($rowId,$qty);
        return redirect()->back();
    }//End Method

    public function decrease_cart_qty($rowId){
        $product=Cart::instance('cart')->get($rowId);
        $qty=$product->qty - 1;
        Cart::instance('cart')->update($rowId,$qty);
        return redirect()->back();
    }//End Method


}
