$(document).ready(function() {
    var w = $(window).width();
    var h = $(window).height() - 34;
    $('.gameFrame,.overlay-start').css({ 'width': w + 'px', 'height': h + 'px' });
});

function startGame() {
    $('.overlay-start,.control-fs-play,.sendGameDialog_open').removeClass('visible');
    $('.game-top-bar__game').hide();
    $('.game-top-bar__pause').addClass('visible');
}

function pauseGame() {
    $('.overlay-start,.control-fs-play,.sendGameDialog_open').addClass('visible');
    $('.game-top-bar__game').hide();
    $('.game-top-bar__pause').removeClass('visible');
}

function showSearchOverlay() {
    $('#overlay-search').addClass('visible');
}

function hideSearchOverlay() {
    $('#overlay-search').removeClass('visible');
}