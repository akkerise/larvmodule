<div class="c-wrap">
    <div class="container">
        <div class="header">
            <h2 class="cat-featured"><span class="icon">🎮</span> Have you played?</h2>
            <a href="/featured" title="See all" class="seeAllBtn">See all</a>
        </div>

        <div class="carousel">
            <div class="inner">
                @if ($data)
                    @foreach ($data as $value)
                        <div class="item big" >
                            <a href="{{ url('game/' . $value['slug'])}}" title="{{$value['name']}}" class="game-link" style="background-image: url('{{$value['logo']}}');">
                                <div class="this-title">
                                    <strong>{{$value['name']}}</strong>
                                    <span class="plays">20.7 mil plays</span>
                                </div>

                                <div class="play-icon"></div>

                                <img data-src="{{$value['logo']}}" alt="{{$value['name']}}" class="game-cover defImg">
                            </a>
                        </div>
                    @endforeach
                @endif
                
            </div>
        </div>
    </div>
</div>