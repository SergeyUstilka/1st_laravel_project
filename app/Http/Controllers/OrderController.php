<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        if (session('cart')) {
            $arr = session('cart');
            foreach ($arr as $items) {
                foreach ($items as $key => $item) {
                    $ids[] = $key;
                    $count[$key] = $item;
                }
            }

            $products = Product::query()->whereIn('id', $ids)->get();
        } else {
            $products = null;
        }
        return view('cart.cart', compact('products', 'count'));
    }
}
