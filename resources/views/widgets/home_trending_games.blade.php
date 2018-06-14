<div class="container assets-container">
    <div class="assets">

        <div class="header">
            <h2 class="cat-featured">
                <span class="icon">🔥</span>
                Trending Games
            </h2>
        </div>

        <div class="inner">
            @if ($data)
                @foreach ($data as $value)
                <div class="item medium">
                    <a href="{{ url('game/' . $value['slug'])}}" title="{{$value['name']}}" class="game-link">
                        <div class="cover-wrap">
                            <img data-src="{{$value['logo']}}" alt="{{$value['name']}}" class="cover defImg">
                        </div>

                        <div class="this-title">
                            <span class="title">{{$value['name']}}</span>
                            <span class="genres">{{$value['category_name']}}</span>
                            250.9 mil plays
                        </div>

                        <div class="play">
                            <div class="btn btn-secondary"><span class="ic ic-play"></span> Play</div>
                        </div>
                    </a>
                </div>
                @endforeach
            @endif
            
        </div>
    </div>
</div>