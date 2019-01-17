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
            <h2 class="title-5 m-b-35">Категории <a href="{{route('admin.category.create')}}" class="btn btn-primary">Добавить</a></h2>
            <div class="table-responsive table-responsive-data2">
                <table class="table table-data2">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>name</th>
                        <th>description</th>
                        <th>slug</th>
                        <th>created_at</th>
                        <th>updated_at</th>
                         <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr class="tr-shadow">

                            <td>{{$category->id}}</td>
                            <td>{{$category->name}}</td>
                            <td>{{$category->description}}</td>
                            <td>{{$category->slug}}</td>
                            <td>{{$category->created_at}}</td>
                            <td>{{$category->updated_at}}</td>
                            <td>
                                <div class="table-data-feature">
                                    <a href="{{route('admin.category.edit', ['category'=>$category])}}" class="item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                        <i class="zmdi zmdi-edit"></i>
                                    </a>
                                    <a href="#" class="item btn-delete" data-toggle="tooltip " data-placement="top" title="" data-original-title="Delete" data-url="{{route('admin.category.destroy',['category'=> $category])}}">
                                        <i class="zmdi zmdi-delete"></i>
                                    </a>
                                </div>
                            </td>
                    </tr>
                        <tr class="spacer"></tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $categories->links() }}
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