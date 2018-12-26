@extends('layouts.admin')
@section('adminContent')
    @dump($product->photos)

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Фото товары</div>
                <div class="card-body">
                    <div class="card-title">
                        <h3 class="text-center title-2">Загрузка фотографий</h3>
                    </div>
                    <hr>
                    <form action="{{route('photo.store',['product'=>$product])}}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="cc-upload" class="control-label mb-1">Выбирите фото</label>
                            <input id="cc-upload" name="images[]" multiple type="file" class="form-control" aria-required="true" aria-invalid="false">
                        </div>
                        <div>
                            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                Загрузить
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">

        @foreach($product->photos as $photo)
        <section class="col-md-4">
            <div class="card" style="border:2px solid #000; padding: 10px;">
                <img src="{{asset('/storage/images/'.$photo->name)}}" alt="">
                <p style="padding: 20px 0 0 0; text-align: center"><a href="#" data-url="{{route('photo.destroy',
                ['product'=>$product, 'photo' => $photo])}}" class="btn btn-danger  btn-delete">Удалить</a></p>
                
            </div>
        </section>
        @endforeach
    </div>
    </div>
    <script>
        window.onload = function () {
            $('.btn-delete').on('click', function (event) {
                event.preventDefault();
                var url = $(this).data('url');
                var row = $(this).closest('section');
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