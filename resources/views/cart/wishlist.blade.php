@extends('layouts.app')
@section('content')
    @dump(session('wishlist'))
    <section class="cart bgwhite p-t-70 p-b-100">
        <div class="container">
            <!-- Cart item -->
            @if(session('wishlist') != null)
                <h3>Понравившиеся товары</h3>
                <div class="container-table-cart pos-relative">
                <div class="wrap-table-shopping-cart bgwhite">
                    <table class="table-shopping-cart">
                        <tr class="table-head">
                            <th class="column-1"></th>
                            <th class="column-2">Product</th>
                            <th class="column-3">Price</th>
                            <th class="column-4"></th>
                        </tr>
                        @foreach($products as $product)
                        <tr class="table-row">
                            <td class="column-1">
                                <div class="cart-img-product b-rad-4 o-f-hidden">
                                    <img src="{{asset('/storage/images/'.$product->img)}}" alt="IMG-PRODUCT">
                                </div>
                            </td>
                            <td class="column-2"><a href="{{route('product',['category'=>\App\Models\Category::query()->where('id',$product->cat_id)->get()[0]->slug, 'product'=>$product->slug])}}">{{$product->name}}</a></td>
                            <td class="column-3">{{$product->price}}</td>

                            <td class="column-5">
                                <div class="block2-btn-addcart w-size1 trans-0-4" style="display: inline-block; position:relative;bottom:auto; left: auto">
                                    <!-- Button -->
                                    <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                                        Add to Cart
                                    </button>
                                </div>

                                <a href="#" class="btn btn-danger delete-from-wish-list" data-id = '{{$product->id}}'><i class="icon_trash_alt" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </table>

                </div>
            </div>
            @else <h2>Вам пока ничего не понравилось</h2>
            @endif
        </div>
    </section>


@endsection