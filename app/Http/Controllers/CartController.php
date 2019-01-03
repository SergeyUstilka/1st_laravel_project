<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return view('cart.cart');
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
            print_r($cart2);
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

//        $cartFinish = [];
//            foreach ($cartStart as $key1 => $items) {
//                foreach ($items as $key => $item) {
//                    if ($key == $_POST['id']) {
//                        $itemFinish = $item+1;
//                        echo $itemFinish;
//                        echo '______________';
//                    }else{
//                        $itemFinish = $item;
//                    }
//                    $cartFinish[$key1] = [$key => $itemFinish];
//                }
//            }
//            $request->session()->pull('cart');
//            print_r($cartStart);
//            print_r($cartFinish);
//            foreach ($cartFinish as $key => $items) {
//                $request->session()->push('cart', $items[$key]);
//            }






    }
}
