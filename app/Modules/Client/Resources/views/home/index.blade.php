@extends('client::layouts.master')
@section('title', 'H5 Gamota - Social gaming, endless fun')

@section('description')Gamee is a social network full of catchy games. Have fun even if you have a minute!@stop

@section('keywords', 'sharing, sharing text, text, sharing photo, photo,')

@section('content')
<div id="categories" class="c-wrap">
    <div class="container">
        @widget('homeCategory')
    </div>
</div>

@widget('homeHaveYouPlayed')
@widget('homeTrendingGames')
@stop
