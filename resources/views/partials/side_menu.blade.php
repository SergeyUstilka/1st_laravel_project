<ul class="p-b-54">
    @foreach($categories as $category)
        <li class="p-t-4">
            <a href="{{route('category', ['category'=> $category])}}" class="s-text13 active1">
                {{$category->name}}
            </a>
        </li>
    @endforeach
</ul>