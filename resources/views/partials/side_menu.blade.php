<ul class="p-b-54">
    @foreach($categories as $category)
        <li class="p-t-4">
            <a href="{{route('category', ['category'=> $category])}}" class="s-text13 active1">
                {{$category->name}}
            </a>
        </li>
    @endforeach
</ul>
<div class="search-product pos-relative bo4 of-hidden">
        <input class="s-text7 size6 p-l-23 p-r-50" type="text" name="search-product" placeholder="Search Products..." id="search_product">

        <button class="flex-c-m size5 ab-r-m color2 color0-hov trans-0-4" type="submit" id="catalog_search_button">
            <i class="fs-12 fa fa-search" aria-hidden="true"></i>
        </button>

    <div id="clever_result"></div>
</div>
<style>
    .search-product{
        position: relative;
        overflow: visible;
    }
    #clever_result{
        position: absolute;
        top: 65px;
        border: 1px solid #efeaea;
        max-height: 200px;
        overflow: scroll;
        display: none;
        background: #fff;
    }
    #clever_result ul li{
        display: block;
        border-bottom: 1px solid grey;
        cursor: pointer;
        font-size: 12px;
        padding: 10px 5px;
    }
    #clever_result ul li:hover{
        background: #00aced;
        color: #fff;
    }

</style>