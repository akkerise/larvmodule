<!doctype html>
<html lang="en">
    <head>
        <!-- Encoding /-->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

        <!-- Title /-->
        <title> @yield('title')</title>
        <meta name="description" content="@yield('description')">
        <meta name='keywords' content="@yield('keywords')" />
        <!-- Social meta tags -->
        <meta property="og:url" content="https://www.gameeapp.com/">
        <meta property="og:site_name" content="GAMEE - Social gaming, endless fun">
        <meta property="og:type" content="website">
        <meta property="og:title" content="GAMEE - Social gaming, endless fun">
        <meta property="og:description" content="Gamee is a social network full of catchy games. Have fun even if you have a minute!">
        <meta property="fb:app_id" content="336892172618">
        <meta property="og:image" content="https://www.gameeapp.com/assets/layout/gamee_og_image.jpg">

        <meta property="twitter:url" content="https://www.twitter.com/gameeapp/">
        <meta property="twitter:card" content="GAMEE - Social gaming, endless fun">
        <meta property="twitter:title" content="GAMEE - Social gaming, endless fun">

        <meta name="twitter:site" content="@Gameeapp">
        <meta name="twitter:description" content="Gamee is a social network full of catchy games. Have fun even if you have a minute!">
        <meta name="twitter:app:name:iphone" content="GAMEE - Social gaming, endless fun">
        <meta name="twitter:app:id:iphone" content="945638210">
        <meta name="twitter:app:url:iphone" content="gameeapp://launch">
        <meta name="twitter:app:name:ipad" content="GAMEE - Social gaming, endless fun">
        <meta name="twitter:app:id:ipad" content="945638210">
        <meta name="twitter:app:url:ipad" content="gameeapp://launch">

        <meta property="al:ios:url" content="gameeapp://launch">
        <meta property="al:ios:app_store_id" content="945638210">
        <meta property="al:ios:app_name" content="GAMEE - Social gaming, endless fun">
        <meta property="al:web:url" content="https://www.gameeapp.com/">
        <meta name="apple-itunes-app" content="app-id=945638210, app-argument=gameeapp://launch">

        <meta property="al:android:url" content="gameeapp://launch">
        <meta property="al:android:app_name" content="GAMEE - Social gaming, endless fun">
        <meta property="al:android:package" content="com.gameeapp.android.app">
        <meta name="twitter:app:name:googleplay" content="GAMEE - Social gaming, endless fun">
        <meta name="twitter:app:id:googleplay" content="com.gameeapp.android.app">

        <meta name="application-name" content="GAMEE">
        <meta name="msapplication-TileColor" content="#FFFFFF">
        <meta name="theme-color" content="#FFFFFF">

        <link rel="terms" href="https://www.gameeapp.com/terms-of-use">
        <link rel="privacy" href="https://www.gameeapp.com/privacy">

        <link rel="dns-prefetch" href="//fonts.googleapis.com">
        <link rel="dns-prefetch" href="//code.jquery.com">
        <link rel="dns-prefetch" href="//cdnjs.cloudflare.com">
        <link rel="dns-prefetch" href="//connect.facebook.net">
        <link rel="dns-prefetch" href="//platform.twitter.com">

        <meta name="apple-mobile-web-app-capable" content="yes">

        <!-- Icons -->
        <link rel="apple-touch-icon" sizes="180x180" href="/brand/apple-touch-icon.png">
        <link rel="icon" type="image/png" href="/brand/favicon-32x32.png" sizes="32x32">
        <link rel="icon" type="image/png" href="/brand/favicon-16x16.png" sizes="16x16">
        <link rel="manifest" href="/brand/manifest.json">
        <link rel="mask-icon" href="/brand/safari-pinned-tab.svg" color="#5bbad5">

        <!-- StyleSheets /-->
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900,300" rel="stylesheet">
        <link href="https://www.gameeapp.com/css/lp_main.min.css?v=11" media="screen" rel="stylesheet">

        <!-- Viewport -->
        <meta name="viewport" content="viewport-fit=cover, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width=device-width, height=device-height, minimal-ui">

        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body class="Games_Games">
        <div id="fb-root"></div>
        <!-- BEGIN: header /-->
        @include('client::blocks.header')
        <!-- END: header /-->

        <!-- BEGIN: Content /-->
        <main id="main">

            <div id="page_games">

                @include('client::blocks.search')

                <div class="this-wrap">
                    @yield('content')           
                </div>
            </div>

            <div id="overlay-search">
                <div class="inner">

                    <div class="in-wrap">
                        <div class="overlay-header">
                            <form action="/?do=findGames-findGames" method="get" class="searchForm" autocomplete="off">
                                <div class="inputWrap">
                                    <input type="text" name="phrase" value="" placeholder="Search games" class="search_phrase" autocorrect="off" autocapitalize="off" autocomplete="off">
                                    <div class="preloader"></div>
                                </div>
                            </form>

                            <div class="close-overlay overlay-search-hide">Close</div>
                        </div>

                        <div id="whisperer" class="whisperer">
                            <div class="in">
                                <h3 class="whisperer-title">Suggested</h3>
                                <div class="results"></div>
                            </div>
                        </div>

                        <div class="noResultsFound">No results found</div>
                    </div>
                </div>
            </div>

            <!-- Community /-->
            @include('client::blocks.community')

        </main>
        <!-- END: content /-->

        <!-- BEGIN: Footer/-->
        @include('client::blocks.footer')
        <!-- END:  Footer /-->

        <!-- Javascript /-->
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        <script>window.jQuery || document.write("<script src='./js/vendor/jquery-1.11.1.min.js'>\x3C/script>")</script>
        <script src="https://www.gameeapp.com/js/LandingPage/plugins.min.js"></script>
        <script src="https://www.gameeapp.com/js/LandingPage/main.min.js?v=12"></script>
        <script src="https://www.gameeapp.com/js/LandingPage/whisperer.min.js?v=12"></script>
        <script src="https://www.gameeapp.com/js/LandingPage/common.min.js"></script>
        <script src="//www.googleadservices.com/pagead/conversion.js"></script>


        <noscript>
        <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=1909354329290715&ev=PageView&noscript=1">
        <div style="display:inline;"><img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/942086117/?value=0&amp;guid=ON&amp;script=0"></div>
        </noscript>
    </body>
</html>
