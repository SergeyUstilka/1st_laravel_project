@extends('layouts.app')
@section('content')
    <section class="cart bgwhite p-t-70 p-b-100">
        <div class="container">
            <!-- Cart item -->
            @if(session('cart') != null)
                <h3>Товары в корзине</h3>
                <div class="container-table-cart pos-relative">
                    <div class="wrap-table-shopping-cart bgwhite">
                        <table class="table-shopping-cart">
                            <tr class="table-head">
                                <th class="column-1"></th>
                                <th class="column-4">Product</th>
                                <th class="column-3">Price</th>
                                <th class="column-3">Quantity</th>
                                <th class="column-5">Total</th>
                                <th class="column-6"></th>
                            </tr>
                            @foreach($products as $product)
                                <tr class="table-row">
                                    <td class="column-1">
                                        <div class="cart-img-product b-rad-4 o-f-hidden">
                                            <img src="{{asset('/storage/images/'.$product->img)}}" alt="IMG-PRODUCT">
                                        </div>
                                    </td>
                                    <td class="column-4"><a href="{{route('product',['category'=>\App\Models\Category::query()->where('id',$product->cat_id)->get()[0]->slug, 'product'=>$product->slug])}}">{{$product->name}}</a></td>
                                    <td class="column-3">{{$product->price}}</td>
                                    <td class="column-3">
                                        <div class="flex-w bo5 of-hidden w-size17">
                                            <button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2 cart-control-minus"  >
                                                <i class="fs-12 fa fa-minus" aria-hidden="true"></i>
                                            </button>

                                            <input class="size8 m-text18 t-center num-product" type="number" data-id="{{$product->id}}" value="{{$count[$product->id]}}">

                                            <button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2 cart-control-plus">
                                                <i class="fs-12 fa fa-plus" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </td>

                                    <td class="column-5">{{$product->price}}</td>
                                    <td class="column-6">
                                        <a href="#" class="btn btn-danger delete-from-cart" data-id = '{{$product->id}}'><i class="icon_trash_alt" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>

                    </div>
                </div>
            @else <h2>Вы пока ничего не положили в корзину</h2>
            @endif
        </div>
    </section>

@endsection