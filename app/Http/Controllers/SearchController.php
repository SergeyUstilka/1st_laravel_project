<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request){
        if(count($request->input('patern'))>0){
            $pattern ="%".$request->input('patern')."%";
            $products=  Product::query()->where('name','like',$pattern)->get();
            $res = [];
            if(count($products)){
                foreach ($products as $product){
                    $res[]=$product->name;
                }
            }

        }else{
            $res = [];
        }
        return json_encode($res);
    }

    public function find(Request $request){
        $name = "%".$request->input('data')."%";
        $products = Product::query()->where('name','like',$name)->get();
        $categories = Category::all();
        $res[] = $products;
        $res[] = $categories;
        return json_encode($res);
    }
}
