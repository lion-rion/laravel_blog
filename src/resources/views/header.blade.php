<div class="main_header_wrap">
    <div class="main-header">
        <div id="header-start">
            <a href="/">
                <img class="header-icon" src="{{ asset('image/laravel.png') }}" loading=""alt="">
            </a>
            <a href="/">
                <h1 id="title">Laravel Blog</h1>
            </a>
        </div>
        <div id="header-end" class="flex">
            <a class="header_search_button_wrap" href="{{route('search')}}}}">
                <i class="fa-solid fa-magnifying-glass header_search_button"></i>
            </a>
            @guest
                <!--ログインしていなかったら表示-->
                <a href="{{ url('/register') }}"><i class="fa-solid fa-circle-user header_login_button"></i></a>
            @endguest
            @auth
                <div id="user_profile_img_wrap" class="user_profile_img_wrap">
                    <i class=" user_profile_img fa-solid fa-circle-user header_login_button"></i>
                    <div id="profile_menu_wrap">
                        <div class="profile_menu">
                            <!--<a href="/profile/{{ Auth::user()->id }}">マイページ</a>-->
                            <div class="profile_menu_under_bar"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                            
                                <a href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log out') }}
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            @endauth
        </div>
    </div>
</div>
<div class="home_menu">
    <nav class="flex home_menu_nav">
        <div class="">
            <a class="home_menu_nav_item" href="/">ホーム</a>
        </div>
        <div class="">
            <a class="home_menu_nav_item" href="{{route('search')}}"><i class="fa-solid fa-magnifying-glass fa_p_margin"></i>検索</a>
        </div>
        <div class="">
            <a class="home_menu_nav_item_last" href="{{ route('create') }}"><i
            class="fa-regular fa-pen-to-square fa_p_margin"></i>投稿</a>
        </div>
    </nav>
</div>
</div>
