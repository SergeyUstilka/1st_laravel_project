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

                    <ul class="p-b-54">
                        @foreach($categories as $category)
                        <li class="p-t-4">
                            <a href="{{route('category', ['category'=> $category])}}" class="s-text13 active1">
                                {{$category->name}}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 col-md-8 col-lg-9 p-b-50">
                <!--  -->
                <div class="flex-sb-m flex-w p-b-35">
                    <div class="flex-w">
                        <div class="rs2-select2 bo4 of-hidden w-size12 m-t-5 m-b-5 m-r-10">
                            <select class="selection-2 select2-hidden-accessible" name="sorting" tabindex="-1" aria-hidden="true">
                                <option>Default Sorting</option>
                                <option>Popularity</option>
                                <option>Price: low to high</option>
                                <option>Price: high to low</option>
                            </select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 146px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-sorting-v0-container"><span class="select2-selection__rendered" id="select2-sorting-v0-container" title="Default Sorting">Default Sorting</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                        </div>

                        <div class="rs2-select2 bo4 of-hidden w-size12 m-t-5 m-b-5 m-r-10">
                            <select class="selection-2 select2-hidden-accessible" name="sorting" tabindex="-1" aria-hidden="true">
                                <option>Price</option>
                                <option>$0.00 - $50.00</option>
                                <option>$50.00 - $100.00</option>
                                <option>$100.00 - $150.00</option>
                                <option>$150.00 - $200.00</option>
                                <option>$200.00+</option>

                            </select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 154px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-sorting-i6-container"><span class="select2-selection__rendered" id="select2-sorting-i6-container" title="Price">Price</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                        </div>
                    </div>

                    <span class="s-text8 p-t-5 p-b-5">
							Showing 1–12 of 16 results
						</span>
                </div>

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