@extends('layouts.admin')
@section('adminContent')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <strong>@if ($user->id) Редактировать @else Создать@endif </strong>пользователя
                </div>
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger">
                        {{$error}}
                    </div>
                @endforeach
                <form action="@if ($user->id) {{route('admin.user.update',compact('user'))}} @else {{route('admin.user.store')}} @endif" method="post" class="">
                    @if ($user->id) <input name="_method" value="PUT" hidden > @endif
                    @csrf
                    <div class="card-body card-block">
                        <div class="form-group">
                            <label for="nf-name" class=" form-control-label">Имя</label>
                            <input type="text" id="nf-name" name="name" @if ($user->id) value="{{$user->name}}" @endif  class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="nf-email" class=" form-control-label">Email</label>
                            <input type="text" id="nf-email" name="email" @if ($user->email) value="{{$user->email}}" @endif  class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="nf-password" class=" form-control-label">Password</label>
                            <input type="text" id="nf-password" name="password" @if ($user->password) value="{{$user->password}}" @endif  class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="nf-cat" class=" form-control-label">Роль</label>
                            <select name="role_id" id="">
                                @foreach($roles as $role)
                                    @if ($user->roles->first()->id == $role->id)
                                <option value="{{$role->id}}" selected>{{$role->name}} - {{$role->id}}</option>
                                    @else
                                <option value="{{$role->id}}">{{$role->name}} - {{$role->id}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fa fa-dot-circle-o"></i> @if ($user->id) Обновить  @else Добавить @endif
                            </button>
                            <a href="{{route('admin.product.index')}}" class="btn btn-danger btn-sm">
                                <i class="fa fa-ban"></i> Отмена
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection