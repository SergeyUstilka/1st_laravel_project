@extends('layouts.admin')
@section('adminContent')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <strong>@if ($category->id) Редактировать @else Создать@endif </strong>категорию
                </div>
                <form action="@if ($category->id) {{route('category.update',compact('category'))}} @else {{route('category.store')}} @endif" method="post" class="">
                    @if ($category->id) <input name="_method" value="PUT" hidden > @endif
                    @csrf
                    <div class="card-body card-block">
                        <div class="form-group">
                            <label for="nf-email" class=" form-control-label">Название</label>
                            <input type="text" id="nf-email" name="name" @if ($category->id) value="{{$category->name}}" @endif  class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="nf-password" class=" form-control-label">Описание</label>
                            <textarea type="text" id="nf-password" name="description" class="form-control">@if ($category->id) {{$category->description}}@endif
                            </textarea>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fa fa-dot-circle-o"></i> @if ($category->id) Обновить  @else Добавить @endif
                            </button>
                            <a href="{{route('category.index')}}" class="btn btn-danger btn-sm">
                                <i class="fa fa-ban"></i> Отмена
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection