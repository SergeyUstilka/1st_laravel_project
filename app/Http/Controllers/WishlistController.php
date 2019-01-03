<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index(){

    }

    public function wishlist(){
//        dd();
        $arr = session('wishlist');
        if(isset($arr)){
            $products = Product::query()->whereIn('id',$arr)->get();
        }else{
            $products = null;
        }
        return view('cart.wishlist',compact('products'));
    }

    public function addTowishList(Request $request){
//        $request->session()->pull('wishlist');
        if(session('wishlist') === null){
            $request->session()->put('wishlist',[]);
        }else if(!in_array($_POST['id'], session('wishlist'))){
            echo 'добавил';
            $product = Product::query()->where('id', $_POST['id'])->get()[0];
            $request->session()->push('wishlist',$product->id);
        }else{
            echo 'такой элемент уже был';
        }

//        print_r(json_encode(session('wishlist')));
//       print_r($product->name);
    }

    public function deletewishlist(Request $request){
//        $request->session()->pull('wishlist');

        $wishes = session('wishlist');
        print_r(session('wishlist'));
        foreach ($wishes as $key => $wish){
            if($wish == $_GET['id']){
                unset($wishes[$key]);
                echo 'совпал'.$wish;
            }
        }
        $request->session()->pull('wishlist');
        if(count($wishes)>0){
            foreach ($wishes as $wish) {
                $request->session()->push('wishlist',$wish);
            }
        }
        print_r(session('wishlist'));

//        print_r($_GET);
    }
}
