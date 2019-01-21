@extends('layouts.app')
@section('content')
    <section class="cart bgwhite p-t-70 p-b-100">
        @if(session('cart') != null)
            <div class="container cart-box">
                <h1>Оформление заказа</h1>
                <div class="row">
                <div class="col-md-6">
                    <form class="leave-comment" action="{{route('checkout.store')}}" method="post">
                        @csrf
                        <h4 class="m-text26 p-b-36 p-t-15">
                            Checkout
                        </h4>

                        <div class="bo4 of-hidden size15 m-b-20">
                            <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="user_name" placeholder="Full Name">
                        </div>

                        <div class="bo4 of-hidden size15 m-b-20">
                            <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="phone_number" placeholder="Phone Number">
                        </div>

                        <div class="bo4 of-hidden size15 m-b-20">
                            <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="email" placeholder="Email">
                        </div>
                        <div class="bo4 of-hidden size15 m-b-20">
                            <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="address" placeholder="Address">
                        </div>

                        <textarea class="dis-block s-text7 size20 bo4 p-l-22 p-r-22 p-t-13 m-b-20" name="comment" placeholder="Message"></textarea>

                        <div class="w-size25">
                            <!-- Button -->
                            <button class="flex-c-m size2 bg1 bo-rad-23 hov1 m-text3 trans-0-4">
                                Send
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <!-- Cart item -->
                        <?php $total = 0 ?>
                        <h3>Товары в корзине</h3>
                        <div class="container-table-cart pos-relative" style="border-bottom: 1px solid #e6e6e6;">
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
                                            <td class="" style="padding: 0 0 0 15px;">
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
                            <div class="" style="padding: 20px;">
                                <h5 class="m-text20 p-b-24" id="cardCheck">
                                    Cart Totals: {{$total }}
                                </h5>
                            </div>
                        </div>

                </div>

            </div>
                @else <h2>Ваша корзина пуста</h2>
                @endif
            </div>
    </section>

@endsection