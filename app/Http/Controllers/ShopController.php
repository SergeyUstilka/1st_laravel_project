<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Entrust\Role;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ShopController extends Controller
{
    public function category(Category $category, Request $request){

        if(isset($category->id)){
            $products = Product::query()->where('cat_id',$category->id)->paginate(2);
            $current_category = $category;
        }else{
            $products = Product::paginate(4);
            $current_category = null;
        }
        return view('shop.category',compact('products', 'current_category'));
    }

    public function product(Category $category, Product $product){
        if($product->category->id != $category->id){
            throw new NotFoundHttpException();
        }
        $photos = $product->photos;
        return view('shop.product',compact('product','category','photos'));
    }

    public function createRole(){
        $role = new Role();
        $role->name='admin';
        $role->display_name='administrator';
        $role->description='Администратор сайта';
        $role->save();

        Auth::user()->attachRole($role);
    }
}
