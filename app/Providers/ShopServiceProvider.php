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
            if (session('cart')) {
                $arr = session('cart');
                foreach ($arr as $items) {
                    foreach ($items as $key => $item) {
                        $ids[] = $key;
                        $count[$key] = $item;
                    }
                }

                $cart_products = Product::query()->whereIn('id', $ids)->get();
            } else {
                $cart_products = null;
            }
            $views->with('categories',Category::all())
            ->with('cart_products',$cart_products);
        });
    }
}
