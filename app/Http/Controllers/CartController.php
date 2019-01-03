<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $arr = session('cart');
        foreach ($arr as $items){
            foreach ($items as $key=>$item){
                $ids[] = $key;
                $count[$key]= $item;
            }
        }

        if(isset($ids)){
            $products = Product::query()->whereIn('id',$ids)->get();
        }else{
            $products = null;
        }
        return view('cart.cart',compact('products', 'count'));
    }

    public function addtocart(Request $request)
    {
//        $request->session()->pull('cart');
//        print_r(session('cart'));
            if (session('cart') === null) {
                $request->session()->put('cart', []);
            }

            $cartStart = session('cart');
            $cart2= [];
            $sovp=0;
            if(count($cartStart) == 0){
                $request->session()->push('cart', [$_POST['id'] => 1]);
                echo 'первый товар';
            }else{
                foreach ($cartStart as $number => $items) {
                    foreach ($items as $key => $item) {
                        if ($key == $_POST['id']) {
                            $sovp++;
                            $cart2[$number]=1;
                        }else{
                            $cart2[$number]=0;
                        }
                    }
                }
                print_r($cart2);
                if(!$sovp){
                    $request->session()->push('cart', [$_POST['id'] => 1]);
                }else{
                    $request->session()->pull('cart');
                    $request->session()->put('cart', []);
                    foreach ($cartStart as $number => $items){
                        foreach ( $items as $key=> $item) {
                            if($cart2[$number]){
                                $request->session()->push('cart', [$key =>++$item]);
                            }
                            else{
                                $request->session()->push('cart', [$key =>$item]);
                            }
                        }
                    }
                }
            }
            print_r(session('cart'));
    }


    public function updatecart(Request $request){
        print_r(session('cart'));
        $cartStart = session('cart');
        $cart2= [];
        $sovp=0;
        foreach ($cartStart as $number => $items) {
            foreach ($items as $key => $item) {
                if ($key == $_POST['id']) {
                    $sovp++;
                    $cart2[$number]=1;
                }else{
                    $cart2[$number]=0;
                }
            }
        }
        if(!$sovp){
            $request->session()->push('cart', [$_POST['id'] => 1]);
        }else{
            $request->session()->pull('cart');
            $request->session()->put('cart', []);
            foreach ($cartStart as $number => $items){
                foreach ( $items as $key=> $item) {
                    if($cart2[$number]){
                        $request->session()->push('cart', [$key =>$_POST['count']]);
                    }
                    else{
                        $request->session()->push('cart', [$key =>$item]);
                    }
                }
            }
        }
        print_r(session('cart'));
    }

    public function deletefromcart(Request $request){
        print_r(session('cart'));
        $cartStart = session('cart');

        $request->session()->pull('cart');
        $request->session()->put('cart', []);
        foreach ($cartStart as $number => $items){
            foreach ( $items as $key=> $item) {
                if($key != $_POST['id']){
                    $request->session()->push('cart', [$key =>$item]);
                }
            }
        }
        print_r(session('cart'));

    }
}
