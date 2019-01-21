@extends('layouts.app')
@section('content')
<div>
    @if ($message = Session::get('status'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
</div>
<div>
<a href="{{route('category')}}">Продолжить покупки</a>
</div>
@endsection