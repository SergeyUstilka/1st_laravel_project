<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        $cart= session('cart');
        if ($cart) {
            $products = Product::query()->whereIn('id', array_keys($cart))->get();
        } else {
            $products = null;
        }
        return view('cart.order', compact('products', 'cart'));
    }
}
