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
            <h2 class="title-5 m-b-35">Роли <a href="{{route('admin.role.create')}}" class="btn btn-primary">Добавить</a></h2>
            <div class="table-responsive table-responsive-data2">
                <table class="table table-data2">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>name</th>
                        <th>display_name</th>
                        <th>description</th>
                        <th>Пользователи</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($roles as $role)
                        <tr class="tr-shadow">

                            <td>{{$role->id}}</td>
                            <td>{{$role->name}}</td>
                            <td>{{$role->display_name}}</td>
                            <td>{{$role->description}}</td>
                            <td>
                                @if ($role->users)
                                    @foreach($role->users as $user)
                                        "{{$user->name}}"
                                    @endforeach
                                @endif
                            </td>
                            <td>
                                <div class="table-data-feature">
                                    <a href="{{route('admin.role.edit', ['category'=>$role])}}" class="item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                        <i class="zmdi zmdi-edit"></i>
                                    </a>
                                    <a href="#" class="item btn-delete" data-toggle="tooltip " data-placement="top" title="" data-original-title="Delete" data-url="{{route('admin.role.destroy',['role'=> $role])}}">
                                        <i class="zmdi zmdi-delete"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr class="spacer"></tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $roles->links() }}
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