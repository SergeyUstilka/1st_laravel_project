<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addTowishList(Request $request){
        $product = Product::query()->where('id', $_POST['id'])->get()[0];
        $request->session()->push('wishlist',$product->name);
//        print_r(json_encode(session('wishlist')));
//       print_r($product->name);
    }
}
