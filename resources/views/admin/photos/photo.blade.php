@extends('layouts.admin')
@section('adminContent')
    @dump($product->photos)

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Фото товара: <b>{{$product->name}}</b></div>
                <div class="card-body">
                    <div class="card-title">
                        <h3 class="text-center title-2">Загрузка фотографий</h3>
                    </div>
                    <hr>
                    <form action="{{route('photo.store',['product'=>$product])}}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="cc-upload" class="control-label mb-1">Выбирите фото</label>
                            <input id="cc-upload" required name="images[]" multiple type="file" class="form-control" aria-required="true" aria-invalid="false">
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
    @if (isset($product->photos[0]))
    <form method="post"  action="{{route('photo.update', ['product'=>$product,'photo'=>$product->photos[0]])}}">
        <input name="_method" value="PUT" hidden >
        @csrf
    <div class="row">

        @foreach($product->photos as $photo)
            <section class="col-md-4">

                <div class="card" style="border:2px solid #000; padding: 10px;">
                    <div class="card-body">
                        @if($photo->main_photo)
                            <div class="form-group">
                                <lable>Главная <input type="radio"  value="{{$photo->id}}" name="main_photo" checked class="btn-update"></lable>

                            </div>
                        @else
                            <div class="form-group">
                            <lable>Сделать главной <input type="radio" value="{{$photo->id}}" name="main_photo" class="btn-update"></lable>

                            </div>
                        @endif
                        <img src="{{asset('/storage/images/'.$photo->name)}}" alt="">
                        <p style="padding: 20px 0 0 0; text-align: center"><a href="#" data-url="{{route('photo.destroy',
                    ['product'=>$product, 'photo' => $photo])}}" class="btn btn-danger  btn-delete">Удалить</a></p>


                    </div>

                </div>

            </section>
            @endforeach

    </div>
        <button type="submit" class="btn btn-lg btn-info btn-block">Обновить</button>
    </form>

    </div>
    @endif
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
            // $('.btn-update').on('click', function (event) {
            //     var url = $(this).data('url');
            //     var parentRadio = $(this).closest('section');
            //     var allRadio = $('.radios');
            //
            //     $.ajaxSetup({
            //         headers: {
            //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //         }
            //     });
            //
            //     $.ajax({
            //         url: mainPhoto,
            //         method: 'POST',
            //         data:{ name: "John", location: "Boston" },
            //         success: function (data) {
            //             allRadio.removeClass('main_photo');
            //             parentRadio.addClass('main_photo');
            //             console.log(data)
            //
            //         },
            //         error: function (data) {
            //             console.log(data);
            //         }
            //     });
            // })
        }
    </script>
@endsection