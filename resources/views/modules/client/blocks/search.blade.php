<header id="gamesHeader">
    <div class="container">
        <a href="/" title="GAMEE - Social gaming, endless fun" id="logo">GAMEE - Social gaming, endless fun</a>
        <div class="searchWrap searchDesktop">
            <form action="/?do=findGames-findGames" method="get" class="searchForm" autocomplete="off">
                <div class="inputWrap">
                    <input type="text" name="phrase" value="" placeholder="🔎 Find games" class="search_phrase" autocorrect="off" autocapitalize="off" autocomplete="off">
                </div>
                <div class="preloader"></div>
            </form>

            <div id="whisperer" class="whisperer">
                <div class="in">
                    <h3>Suggested</h3>
                    <div class="results"></div>
                </div>
            </div>
        </div>
        @widget('login')
    </div>
</header>