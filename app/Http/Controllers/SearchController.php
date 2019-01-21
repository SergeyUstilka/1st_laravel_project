<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request){
        $pattern ="%".$request->input('patern')."%";
        $products=  Product::query()->where('name','like',$pattern)->get();
        if(count($products)){
            foreach ($products as $product){
                $res[]=$product->name;
            }
            return json_encode($res);
        }else{
            return [];
        }
    }
}
