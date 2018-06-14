@extends('client::layouts.playgame')

@section('content')

<div class="overlayVisible">
    <div class="game-top-bar second">
        <span class="ic ic-close-game game-top-bar__close-game"></span>
        <div class="game-top-bar__userscore">Score: <span class="totalScore">0</span></div>
        <div class="game-top-bar__game">
            <div class="game-avatar"><img src="https://d29zfk7accxxr5.cloudfront.net/games/game-191/f291681912baf20128a115f53f93f1dc.jpg" class="game-img"></div> <span class="game-name">Street Racer</span></div>
        <div class="game-top-bar__pause" onclick="pauseGame()"></div>
    </div>
    <div class="overlay-start visible">
        <div class="fullscreen-control control-fs-play visible" onclick="startGame();"></div>
        <div class="fullscreen-control control-fs-resume"></div>
    </div>
    <!-- show game -->
    <iframe class="gameFrame" name="game" scrolling="no" src="{{$data['link']}}"></iframe>
</div>
<div class="bottom-controls">
    <div class="circle-btn sendGameDialog_open visible">
        <div class="circle"></div><span>Send game</span>
    </div>
    <div class="circle-btn game-restart">
        <div class="circle"></div>
        <span>Restart</span>
    </div>
</div>
@stop
