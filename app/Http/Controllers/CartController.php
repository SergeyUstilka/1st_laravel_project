<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{


    public function index()
    {
        $cart= session('cart');
        if ($cart) {
            $products = Product::query()->whereIn('id', array_keys($cart))->get();
        } else {
            $products = null;
        }
        return view('cart.cart', compact('products', 'cart'));
    }




    public function updatecart(Request $request)
    {
        $cart = session('cart');
        $count = $request->input('count');
        $updatedProduct = $cart[$request->input('id')];
        if(isset($updatedProduct)){
            $cart[$request->input('id')] = $count;
        }
        session(['cart'=>$cart]);

        // Делаем выборку товаров из сесии и отправляем на фронт
        $arr = session('cart');
        $products = Product::query()->whereIn('id', array_keys($arr))->get();
        $res[]=$products;
        $res[] = $arr;
        return json_encode($res);
    }

    public function deletefromcart(Request $request)
    {
        $cart = $request->session()->get('cart',[]);
        unset($cart[$request->input('id')]);
        session(['cart'=>$cart]);
        // Делаем выборку товаров из сесии и отправляем на фронт
        $arr = session('cart');
        $products = Product::query()->whereIn('id', array_keys($arr))->get();
        $res[]=$products;
        $res[] = $arr;
        return json_encode($res);

    }

    public function newAddtoCart(Request $request){
//                $request->session()->pull('cart');
        $cart = $request->session()->get('cart',[]);
        $prod_id = $request->input('id');
        $count = $request->input('count');
        if(isset($cart[$prod_id])){
            $cart[$prod_id]+=intval($count);
        }else{
           $cart[$prod_id]=intval($count);
        }

        session(['cart'=>$cart]);

        // Делаем выборку товаров из сесии и отправляем на фронт
        $arr = session('cart');
        $products = Product::query()->whereIn('id', array_keys($arr))->get();
        $res[]=$products;
        $res[] = $arr;
        return json_encode($res);
//        print_r($arr);
    }

}
