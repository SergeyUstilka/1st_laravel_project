<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ShopController extends Controller
{
    public function category(Category $category, Request $request){
        $categories = Category::all();

        if(isset($category->id)){
            $products = Product::query()->where('cat_id',$category->id)->paginate(2);
        }else{
            $products = Product::paginate(4);
        }
        return view('shop.category',compact('products', 'categories'));
    }

    public function product(Category $category, Product $product){
        if($product->category->id != $category->id){
            throw new NotFoundHttpException();
        }
        $photos = $product->photos;
        return view('shop.product',compact('product','category','photos'));
    }
}
