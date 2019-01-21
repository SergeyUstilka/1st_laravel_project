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
            <h2 class="title-5 m-b-35">Статусы заказа <a href="{{route('admin.order_status.create')}}" class="btn btn-primary">Добавить</a></h2>
            <div class="table-responsive table-responsive-data2">
                <table class="table table-data2">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>name</th>
                        <th>description</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($order_statuses as $order_status)
                        <tr class="tr-shadow">

                            <td>{{$order_status->id}}</td>
                            <td>{{$order_status->name}}</td>
                            <td>{{$order_status->description}}</td>
                            <td>
                                <div class="table-data-feature">
                                    <a href="{{route('admin.order_status.edit', ['order_status'=>$order_status])}}" class="item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                        <i class="zmdi zmdi-edit"></i>
                                    </a>
                                    <a href="#" class="item btn-delete" data-toggle="tooltip " data-placement="top" title="" data-original-title="Delete" data-url="{{route('admin.order_status.destroy',['order_status'=> $order_status])}}">
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