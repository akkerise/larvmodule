<ul class="categories">
    <li class="searchBtn overlay-search-show"><a title="Search">🔎 Search</a></li>
    @if ($data)
    @foreach ($data as $value)
    <li>
        <a href="{{ url('category/' . $value['category_id'])}}" title="{{$value['name']}}" class="cat-link"><img src="{{$value['icon']}}" alt="{{$value['name']}}" class="icon"> {{$value['name']}}</a>
    </li>
    @endforeach
    @endif
</ul>