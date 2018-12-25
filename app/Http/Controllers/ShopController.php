<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function category(Category $category){
//        dd($category);
        $products = Product::query()->where('cat_id',$category->id)->get();
        return view('shop.category',compact('products'));
    }

    public function product(){
        $order = Order::with('products')->firstOrCreate(['user_id'=>1]);
        dump($order);
    }
}
