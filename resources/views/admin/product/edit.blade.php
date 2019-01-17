@extends('layouts.admin')
@section('adminContent')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <strong>@if ($product->id) Редактировать @else Создать@endif </strong>товар
                </div>
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger">
                        {{$error}}
                    </div>
                @endforeach
                <form action="@if ($product->id) {{route('admin.product.update',compact('product'))}} @else {{route('admin.product.store')}} @endif" method="post" class="">
                    @if ($product->id) <input name="_method" value="PUT" hidden > @endif
                    @csrf
                    <div class="card-body card-block">
                        <div class="form-group">
                            <label for="nf-name" class=" form-control-label">Название</label>
                            <input type="text" id="nf-name" name="name" @if ($product->id) value="{{$product->name}}" @endif  class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="nf-price" class=" form-control-label">Цена</label>
                            <input type="text" id="nf-email" name="price" @if ($product->id) value="{{$product->price}}" @endif  class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="nf-cat" class=" form-control-label">Категория</label>
                            <select name="cat_id" id="">
                                @foreach($categories as $category)
                                    @if ($product->cat_id == $category->id)
                                <option value="{{$category->id}}" selected>{{$category->name}} - {{$category->id}}</option>
                                    @else
                                <option value="{{$category->id}}">{{$category->name}} - {{$category->id}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nf-password" class=" form-control-label">Описание</label>
                            <textarea type="text" id="nf-password" name="content" class="form-control">@if ($product->id) {{$product->content}}@endif
                            </textarea>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fa fa-dot-circle-o"></i> @if ($product->id) Обновить  @else Добавить @endif
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