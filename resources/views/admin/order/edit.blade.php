@extends('layouts.admin')
@section('adminContent')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <strong>@if ($order->id) Редактировать @else Создать@endif </strong>заказ
                </div>
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger">
                        {{$error}}
                    </div>
                @endforeach
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Имя зарег. пользователя</th>
                            <th>Email</th>
                            <th>Адрес</th>
                            <th>Номер телефона</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr class="tr-shadow">

                                <td>{{$order->id}}</td>
                                <td>
                                    @foreach($users as $user)
                                        @if($user->id == $order->user_id )
                                            {{$user->name}}
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{$order->email}}</td>
                                <td>{{$order->address}}</td>
                                <td>{{$order->phone_number}}</td>
                            </tr>
                            <tr class="spacer"></tr>
                        </tbody>
                    </table>
                </div>
                <div class="table-responsive table-responsive-data2">
                    <h3>Товары в заказе</h3>
                    <table class="table table-data2">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Название</th>
                            <th>Цена</th>
                            <th>Количество</th>
                            <th>Сумма</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                        <tr class="tr-shadow">
                            <td><img src="{{asset('/storage/images/'.$product->img)}}" alt="" style="max-width:100px;"></td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->price}}</td>
                            @foreach($order_product as $item)
                                @if($item->product_id == $product->id)
                                    <td>{{ $count =  $item->count}}</td>
                                @endif
                            @endforeach
                            <td>{{$count*$product->price}}</td>
                        </tr>
                        @endforeach
                        <tr class="spacer"></tr>
                        </tbody>
                    </table>
                </div>
                <form action="{{route('admin.order.update',compact('order'))}}" method="post" class="">
                     <input name="_method" value="PUT" hidden >
                    @csrf
                    <div class="card-body card-block">
                        <div class="form-group">
                            <label for="nf-email" class=" form-control-label">Статус заказа</label>
                            <select name="order_status_id" id="">

                            @foreach($order_statuses as $order_status)
                                @if($order_status->id == $order->order_status_id )
                                        <option value="{{$order_status->id}}" selected>{{$order_status->name}}</option>
                                @else
                                        <option value="{{$order_status->id}}">{{$order_status->name}}</option>
                                @endif
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nf-password" class=" form-control-label">Комментарий</label>
                            <textarea type="text" id="nf-password" name="comment" class="form-control">{{$order->comment}}</textarea>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fa fa-dot-circle-o"></i> @if ($order->id) Обновить  @else Добавить @endif
                            </button>
                            <a href="{{route('admin.order.index')}}" class="btn btn-danger btn-sm">
                                <i class="fa fa-ban"></i> Отмена
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection