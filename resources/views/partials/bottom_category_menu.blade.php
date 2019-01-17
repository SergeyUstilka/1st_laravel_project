<ul>
    @foreach($categories as $category)
    <li class="p-b-9">
        <a href="{{route('category', ['category'=> $category])}}" class="s-text7">
            {{$category->name}}
        </a>
    </li>
    @endforeach
</ul>