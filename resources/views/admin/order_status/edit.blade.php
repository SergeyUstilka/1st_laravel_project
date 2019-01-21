@extends('layouts.admin')
@section('adminContent')
    @dump($errors)
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <strong>@if ($order_status->id) Редактировать @else Создать@endif </strong>статус заказа
                </div>
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger">
                        {{$error}}
                    </div>
                @endforeach
                <form action="@if ($order_status->id) {{route('admin.order_status.update',compact('order_status'))}} @else {{route('admin.order_status.store')}} @endif" method="post" class="">
                    @if ($order_status->id) <input name="_method" value="PUT" hidden > @endif
                    @csrf
                    <div class="card-body card-block">
                        <div class="form-group">
                            <label for="nf-email" class=" form-control-label">Название</label>
                            <input type="text" id="nf-email" name="name" @if ($order_status->id) value="{{$order_status->name}}" @endif  class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="nf-password" class=" form-control-label">Описание</label>
                            <textarea type="text" id="nf-password" name="description" class="form-control">@if ($order_status->id) {{$order_status->description}}@endif
                            </textarea>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fa fa-dot-circle-o"></i> @if ($order_status->id) Обновить  @else Добавить @endif
                            </button>
                            <a href="{{route('admin.order_status.index')}}" class="btn btn-danger btn-sm">
                                <i class="fa fa-ban"></i> Отмена
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection