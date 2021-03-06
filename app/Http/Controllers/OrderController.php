<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart= session('cart');
        if ($cart) {
            $products = Product::query()->whereIn('id', array_keys($cart))->get();
        } else {
            $products = null;
        }
        return view('cart.order', compact('products', 'cart'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = new Order($request->except('_token'));
        if(Auth::user()){
            $order->user_id =Auth::user()->id;
        }else{
            $order->user_id = 11;
        }
        $order->order_status_id = 2;
        $order->save();
        $cart = $request->session()->get('cart',[]);
        foreach ($cart as $product=> $count) {
            $order_product = new OrderProduct();
            $order_product->order_id = $order->id;
            $order_product->count = $count;
            $order_product->product_id = $product;
            $order_product->price = Product::find($product)->price;
            $order_product->save();
        }
        $request->session()->pull('cart');
        $request->session()->flash('status','Ваш заказ уже в работе');
        return redirect(route('category'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
