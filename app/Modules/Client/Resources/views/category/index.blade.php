@extends('client::layouts.master')

@section('title')
{{$detailCategory['name']}} - H5 Gamota
@stop
@section('description'){{$detailCategory['description']}}@stop
@section('keywords', 'sharing, sharing text, text, sharing photo, photo,')

@section('content')
<div class="section_header">
    <div class="container">
        <a title="Games" class="goBackBtn" href="{{ url('/')}}">Back</a>

        <h1><img src="{{$detailCategory['icon']}}" alt="Arcade" class="icon"> {{$detailCategory['name']}}</h1>
    </div>
</div>

<div class="container assets-container">
    <div class="assets">
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

    <div class="asset-loading"><span class="icn"></span></div>

    <div class="text-center">
        <a href="/category/12?categoryGames-limit=12&amp;categoryGames-offset=12&amp;do=categoryGames-loadMore" class="btn btn-loadMore" data-offset="12" data-limit="12">Load more</a>
    </div>
</div>
</div>
@stop
