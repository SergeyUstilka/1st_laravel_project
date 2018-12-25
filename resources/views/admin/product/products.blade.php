@extends('layouts.admin')
@section('adminContent')
    <div class="row">
        <div class="col-md-12">
            <!-- DATA TABLE -->
            <h2 class="title-5 m-b-35">Товары <a href="{{route('product.create')}}" class="btn btn-primary">Добавить</a></h2>
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
                        <td>img</td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->price}}</td>
                        <td>{{$product->content}}</td>
                        <td>{{$product->cat_id}}</td>
                        {{--<td>{{$product->created_at}}</td>--}}
                        {{--<td>{{$product->updated_at}}</td>--}}
                        <td>
                            <a href="{{route('product.edit', ['product'=>$product])}}" class="btn btn-primary">Редактировать</a>
                            <br>
                            <a href="#" class="btn btn-danger btn-delete" data-url="{{route('product.destroy',['product'=>$product])}}}">Удалить</a>
                        </td>
                    </tr>
                        @endforeach
                    </tbody>
                </table>
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