@extends('layouts.admin')
@section('adminContent')
    @dump($errors)
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <strong>@if ($role->id) Редактировать @else Создать@endif </strong>роль
                </div>
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger">
                        {{$error}}
                    </div>
                @endforeach
                <form action="@if ($role->id) {{route('admin.role.update',compact('role'))}} @else {{route('admin.role.store')}} @endif" method="post" class="">
                    @if ($role->id) <input name="_method" value="PUT" hidden > @endif
                    @csrf
                    <div class="card-body card-block">
                        <div class="form-group">
                            <label for="nf-email" class=" form-control-label">Название</label>
                            <input type="text" id="nf-email" name="name" @if ($role->id) value="{{$role->name}}" @endif  class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="nf-display_name" class=" form-control-label">Отображаемое имя</label>
                            <input type="text" id="nf-display_name" name="display_name" @if ($role->id) value="{{$role->display_name}}" @endif  class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="nf-password" class="form-control-label">Описание</label>
                            <textarea type="text" id="nf-password" name="description" class="form-control">@if ($role->id) {{$role->description}}@endif
                            </textarea>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fa fa-dot-circle-o"></i> @if ($role->id) Обновить  @else Добавить @endif
                            </button>
                            <a href="{{route('admin.role.index')}}" class="btn btn-danger btn-sm">
                                <i class="fa fa-ban"></i> Отмена
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection