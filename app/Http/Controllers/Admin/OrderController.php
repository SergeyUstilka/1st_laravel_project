<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderStatus;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $order_type = $request->input('order_status');
        if($order_type){
            $orderes = Order::query()->where('order_status_id',$order_type)->orderBy('id', 'desc')->get();
        }else{
            $orderes = Order::orderBy('id', 'desc')->get();
        }
        $order_statuses = OrderStatus::all();
        $users=User::all();
        return view('admin.order.orders',compact('orderes','users','order_statuses','order_type'));
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
        //
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
        $order_statuses = OrderStatus::all();
        $users=User::all();
        $products = $order->products;
        $order_product = OrderProduct::query()->where('order_id', $order->id)->get();
        return view('admin.order.edit', compact('order','order_statuses','users','products','order_product'));
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
        $order->update($request->all());
        return redirect(route('admin.order.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return [];
    }
}
