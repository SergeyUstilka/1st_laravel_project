@extends('layouts.admin')
@section('adminContent')
    <div class="row">
        <div class="col-md-12">
            <!-- DATA TABLE -->
            <h2 class="title-5 m-b-35">Товары <a href="{{route('admin.product.create')}}" class="btn btn-primary">Добавить</a></h2>
            <div class="table-responsive table-responsive-data2">
                <table class="table table-borderless table-data3">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>img</th>
                        <th>name</th>
                        <th>price</th>
                        <th>content</th>
                        <th>cat_id</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td>{{$product->id}}</td>
                        <td><img src="{{asset('/storage/images/'.$product->img)}}" alt=""></td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->price}}</td>
                        <td>{{$product->content}}</td>
                        <td>{{$product->cat_id}}</td>
                        {{--<td>{{$product->created_at}}</td>--}}
                        {{--<td>{{$product->updated_at}}</td>--}}
                        <td style="vertical-align: middle; text-align: center">
                            <a href="{{route('admin.product.edit', ['product'=>$product])}}" class="btn btn-primary">Редактировать</a>
                            <br>
                            <a href="{{route('admin.photo.index',['product'=>$product])}}" class="btn btn-info" style="display: inline-block; margin: 20px 0">Фотографии ({{count($product->photos)}})</a>
                            <br>
                            <a href="#" class="btn btn-danger btn-delete" data-url="{{route('admin.product.destroy',['product'=>$product])}}">Удалить</a>
                        </td>
                    </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$products->links()}}
            </div>
            <!-- END DATA TABLE -->
        </div>
    </div>
    <script>
        window.onload = function () {
            $('.btn-delete').on('click', function (event) {
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

                    }
                });
            })
        }
    </script>
@endsection