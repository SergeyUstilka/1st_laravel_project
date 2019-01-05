<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{


    public function index()
    {
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

    public function addtocart(Request $request)
    {
//        $request->session()->pull('cart');
//        print_r(session('cart'));
        if (session('cart') === null) {
            $request->session()->put('cart', []);
        }


        // Перебираем корзину, проверяем есть ли совпадения, добавляем  товар
        $cartStart = session('cart');
        $cart2 = [];
        $sovp = 0;
        if (count($cartStart) == 0) {
            $request->session()->push('cart', [$_POST['id'] => 1]);
        } else {
            foreach ($cartStart as $number => $items) {
                foreach ($items as $key => $item) {
                    if ($key == $_POST['id']) {
                        $sovp++;
                        $cart2[$number] = 1;
                    } else {
                        $cart2[$number] = 0;
                    }
                }
            }
            if (!$sovp) {
                $request->session()->push('cart', [$_POST['id'] => 1]);
            } else {
                $request->session()->pull('cart');
                $request->session()->put('cart', []);
                foreach ($cartStart as $number => $items) {
                    foreach ($items as $key => $item) {
                        if ($cart2[$number]) {
                            $request->session()->push('cart', [$key => ($item + (1*$_POST['count']))]);
                        } else {
                            $request->session()->push('cart', [$key => $item]);
                        }
                    }
                }
            }
        }

        // Делаем выборку товаров из сесии и отправляем на фронт
        $arr = session('cart');
        foreach ($arr as $items) {
            foreach ($items as $key => $item) {
                $ids[] = $key;
                $count[$key] = $item;
            }
        }
        $products = Product::query()->whereIn('id', $ids)->get();
        $res[]=$products;
        $res[] = $count;
        return json_encode($res);

    }


    public function updatecart(Request $request)
    {
        $cartStart = session('cart');
        $cart2 = [];
        $sovp = 0;
        foreach ($cartStart as $number => $items) {
            foreach ($items as $key => $item) {
                if ($key == $_POST['id']) {
                    $sovp++;
                    $cart2[$number] = 1;
                } else {
                    $cart2[$number] = 0;
                }
            }
        }
        if (!$sovp) {
            $request->session()->push('cart', [$_POST['id'] => 1]);
        } else {
            $request->session()->pull('cart');
            $request->session()->put('cart', []);
            foreach ($cartStart as $number => $items) {
                foreach ($items as $key => $item) {
                    if ($cart2[$number]) {
                        $request->session()->push('cart', [$key => $_POST['count']]);
                    } else {
                        $request->session()->push('cart', [$key => $item]);
                    }
                }
            }
        }
        // Делаем выборку товаров из сесии и отправляем на фронт
        $arr = session('cart');
        foreach ($arr as $items) {
            foreach ($items as $key => $item) {
                $ids[] = $key;
                $count[$key] = $item;
            }
        }
        $products = Product::query()->whereIn('id', $ids)->get();
        $res[]=$products;
        $res[] = $count;
        return json_encode($res);
    }

    public function deletefromcart(Request $request)
    {
        $cartStart = session('cart');

        $request->session()->pull('cart');
        $request->session()->put('cart', []);
        foreach ($cartStart as $number => $items) {
            foreach ($items as $key => $item) {
                if ($key != $_POST['id']) {
                    $request->session()->push('cart', [$key => $item]);
                }
            }
        }
        // Делаем выборку товаров из сесии и отправляем на фронт

        $arr = session('cart');
        if($arr){
            foreach ($arr as $items) {
                foreach ($items as $key => $item) {
                    $ids[] = $key;
                    $count[$key] = $item;
                }
            }
            $products = Product::query()->whereIn('id', $ids)->get();
            $res[]=$products;
            $res[] = $count;
            return json_encode($res);
        }else{
            return null;
        }

    }
}
