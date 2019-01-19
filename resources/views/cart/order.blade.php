@extends('layouts.app')
@section('content')
    <section class="cart bgwhite p-t-70 p-b-100">
        @if(session('cart') != null)
            <div class="container cart-box">
                <h1>Оформление заказа</h1>
                <div class="row">
                <div class="col-md-6"></div>
                <div class="col-md-6">
                    <!-- Cart item -->
                        <?php $total = 0 ?>
                        <h3>Товары в корзине</h3>
                        <div class="container-table-cart pos-relative">
                            <div class="wrap-table-shopping-cart bgwhite">
                                <table class="table-shopping-cart" style="min-width: auto">
                                    <tr class="table-head">
                                        <th class=""></th>
                                        <th class="">Product</th>
                                        <th>Count</th>
                                        <th class="">Price</th>
                                        <th class="">Total</th>
                                    </tr>
                                    @foreach($products as $product)
                                        <tr class="table-row">
                                            <td class="">
                                                <div class="cart-img-product b-rad-4 o-f-hidden">
                                                    <img src="{{asset('/storage/images/'.$product->img)}}" alt="IMG-PRODUCT">
                                                </div>
                                            </td>
                                            <td class=""><a href="{{route('product',['category'=>\App\Models\Category::query()->where('id',$product->cat_id)->get()[0]->slug, 'product'=>$product->slug])}}"  target="_blank">{{$product->name}}</a></td>
                                            <td>{{$cart[$product->id]}}</td>
                                            <td class="">{{$product->price}}</td>
                                            <td class=" product-total" >{{$product->price*$cart[$product->id]}}</td>
                                            <?php $total+=$product->price*$cart[$product->id]?>
                                        </tr>
                                    @endforeach
                                </table>

                            </div>
                            <div class="bo9 w-size18 p-l-40 p-r-40 p-t-30 p-b-38 m-t-30 m-r-0 m-l-auto p-lr-15-sm">
                                <h5 class="m-text20 p-b-24" id="cardCheck">
                                    Cart Totals: {{$total }}
                                </h5>
                            </div>
                        </div>

                </div>

            </div>
        </div>
        @else <h2>Ваша корзина пуста</h2>
        @endif
    </section>

@endsection