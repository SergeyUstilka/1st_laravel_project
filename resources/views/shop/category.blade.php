@extends('layouts.app')
@section('content')

<section class="bgwhite p-t-55 p-b-65">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
                <div class="leftbar p-r-20 p-r-0-sm">
                    <!--  -->
                    <h4 class="m-text14 p-b-7">
                        Categories
                    </h4>

                   @include('partials.side_menu')
                </div>
            </div>
            <div class="col-sm-6 col-md-8 col-lg-9 p-b-50" id="sg_catalog_products">
                @if ($message = Session::get('status'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
                @if($current_category)
                    <div class="row">
                        <div class="description">
                            <h2>Kатегория: <b style="color:green">{{$current_category->name}}</b></h2>
                        @if(!isset($_GET['page']) or $_GET['page']==1)
                            <h3>Описание</h3>
                                <p>{{$current_category->description}}</p>
                    @endif
                        </div>
                    </div>
                @endif

            <!-- Product -->
                <div class="row">

                    @foreach($products as $product)
                    <div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
                        <!-- Block2 -->
                        <div class="block2">
                            <div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">
                                <img src="{{asset('/storage/images/'.$product->img)}}" alt="IMG-PRODUCT">

                                <div class="block2-overlay trans-0-4">
                                    <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4" data-url="{{route('addtowishlist')}}" data-id="{{$product->id}}">
                                        <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                                        <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
                                    </a>

                                    <div class="block2-btn-addcart w-size1 trans-0-4" data-id="{{$product->id}}">
                                        <!-- Button -->
                                        <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                                            Add to Cart
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="block2-txt p-t-20">

                                <a href="{{route('product',['category'=>\App\Models\Category::query()->where('id',$product->cat_id)->get()[0]->slug, 'product'=>$product->slug])}}" class="block2-name dis-block s-text3 p-b-5">
                                    {{$product->name}}
                                </a>

                                <span class="block2-price m-text6 p-r-5">
										BYN {{$product->price}}
									</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="pagination flex-m flex-w p-t-26">
                    {{$products->links()}}
                    {{--<a href="#" class="item-pagination flex-c-m trans-0-4 active-pagination">1</a>--}}
                    {{--<a href="#" class="item-pagination flex-c-m trans-0-4">2</a>--}}
                </div>
            </div>
        </div>
    </div>
</section>
    @endsection