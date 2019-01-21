@extends('layouts.admin')
@section('adminContent')
    <div class="row">
        <div class="col-md-12">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
        @endif
        <!-- DATA TABLE -->
            <h2 class="title-5 m-b-35">Заказы</h2>

                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <form action="{{route('admin.order.index')}}" method="GET">
                            <div class="rs-select2--light rs-select2--md">
                                <select class="js-select2" name="order_status">
                                    @if($order_type == 0)

                                    <option selected="selected" value="0">Любой статус</option>
                                    @else
                                        <option  value="0">Любой статус</option>
                                    @endif
                                    @foreach($order_statuses as $order_status)
                                        @if($order_type == $order_status->id)
                                            <option value="{{$order_status->id}}" selected>{{$order_status->name}}</option>
                                        @else
                                           <option value="{{$order_status->id}}">{{$order_status->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <div class="dropDownSelect2"></div>
                            </div>
                            <button class="au-btn-filter" type="submit"><i class="zmdi zmdi-filter-list"></i>Фильтровать</button>
                        </form>

                    </div>
                    <div class="table-data__tool-right">
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            <i class="zmdi zmdi-plus"></i>add item</button>
                        <div class="rs-select2--dark rs-select2--sm rs-select2--dark2">
                            <select class="js-select2" name="type">
                                <option selected="selected">Export</option>
                                <option value="">Option 1</option>
                                <option value="">Option 2</option>
                            </select>
                            <div class="dropDownSelect2"></div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive table-responsive-data2">
                <table class="table table-data2">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Имя зарег. пользователя</th>
                        <th>Email</th>
                        <th>Адрес</th>
                        <th>Номер телефона</th>
                        {{--<th>Имя заказчика</th>--}}
                        <th>Комментарий заказчика</th>
                        <th>Статус заказа</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orderes as $order)
                        <tr class="tr-shadow">

                            <td>{{$order->id}}</td>
                            <td>
                                @foreach($users as $user)
                                    @if($user->id == $order->user_id )
                                        {{$user->name}}
                                    @endif
                                @endforeach
                            </td>
                            <td ><span class="block-email">{{$order->email}}</span></td>
                            <td>{{$order->address}}</td>
                            <td>{{$order->phone_number}}</td>
                            {{--<td>{{$order->user_name}}</td>--}}
                            <td>{{$order->comment}}</td>
                            <td>
                                @foreach($order_statuses as $order_status)
                                    @if($order_status->id == $order->order_status_id)
                                        {{$order_status->name}}
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                <div class="table-data-feature">
                                    <a href="{{route('admin.order.edit', ['order'=>$order])}}" class="item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                        <i class="zmdi zmdi-edit"></i>
                                    </a>
                                    <a href="#" class="item btn-delete" data-toggle="tooltip " data-placement="top" title="" data-original-title="Delete" data-url="{{route('admin.order.destroy',['order'=> $order])}}">
                                        <i class="zmdi zmdi-delete"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr class="spacer"></tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- END DATA TABLE -->
        </div>
    </div>
    <script>
        window.onload = function() {
            $('.btn-delete').on('click',function (event) {
                event.preventDefault();
                var url = $(this).data('url');
                var row = $(this).closest('tr');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: url,
                    method: 'DELETE',
                    success: function () {
                        row.css('display', 'none');

                    },
                    error: function (data) {
                        console.log(data);

                    }
                });
            })
        }
    </script>
@endsection