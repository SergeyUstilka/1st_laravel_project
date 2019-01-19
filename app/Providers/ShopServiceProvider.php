<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ShopServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->mainSiteData();
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function mainSiteData(){
        View::composer(['partials.side_menu','partials.bottom_category_menu','layouts.app'], function ($views){
            $cart = session('cart',[]);
            if (session('cart')) {
                $cart_products = Product::query()->whereIn('id', array_keys($cart))->get();
            } else {
                $cart_products = null;
            }
            $views->with('categories',Category::all())
            ->with(['cart_products'=>$cart_products,'cart'=>$cart]);
        });
    }
}
