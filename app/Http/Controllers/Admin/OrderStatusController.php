<?php

namespace App\Http\Controllers\Admin;

use App\Models\OrderStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order_statuses =  OrderStatus::all();
        return view('admin.order_status.order_status',compact('order_statuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $order_status = new OrderStatus();
        return view('admin.order_status.edit',compact('order_status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order_status = new OrderStatus($request->except('_token'));
        $order_status->save();
        $request->session()->flash('status','Статус заказа добавлен');
        return redirect(route('admin.order_status.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrderStatus  $orderStatus
     * @return \Illuminate\Http\Response
     */
    public function show(OrderStatus $orderStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderStatus  $orderStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderStatus $order_status)
    {
        return view('admin.order_status.edit',compact('order_status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderStatus  $orderStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderStatus $order_status)
    {
        $order_status->update($request->all());
        return redirect(route('admin.order_status.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderStatus  $orderStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderStatus $orderStatus)
    {
        $orderStatus->delete();
        return [];
    }
}
