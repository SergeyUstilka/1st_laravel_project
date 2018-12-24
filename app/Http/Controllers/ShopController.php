<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function category(Category $category){
//        dd($category);
        $products = Product::query()->where('cat_id',$category->id)->get();
        return view('shop.category',compact('products'));
    }
}
