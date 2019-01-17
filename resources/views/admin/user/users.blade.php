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
            <h2 class="title-5 m-b-35">Пользователи <a href="{{route('admin.user.create')}}" class="btn btn-primary">Добавить</a></h2>
            <div class="table-responsive table-responsive-data2">
                <table class="table table-data2">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>name</th>
                        <th>email</th>
                        <th>Роли</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr class="tr-shadow">

                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                <?php
                                $items = $user->roles;
                                    foreach($items as $item){
                                        echo($item->name);
                                    }
                                ?>
                            </td>
                            <td>
                                <div class="table-data-feature">
                                    <a href="{{route('admin.user.edit', ['user'=>$user])}}" class="item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                        <i class="zmdi zmdi-edit"></i>
                                    </a>
                                    <a href="#" class="item btn-delete" data-toggle="tooltip " data-placement="top" title="" data-original-title="Delete" data-url="{{route('admin.user.destroy',['user'=> $user])}}">
                                        <i class="zmdi zmdi-delete"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr class="spacer"></tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $users->links() }}
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