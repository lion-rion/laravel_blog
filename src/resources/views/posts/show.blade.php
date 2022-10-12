<!DOCTYPE HTML>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>{{ $post->title }}</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="icon" href="{{ asset('image/laravel.png') }}">
    <link rel="stylesheet" href='{{ asset('/css/sample.css') }}'>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.0.0/css/all.css">
    <script src="{{ mix('js/jquery.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
</head>
<body>
    <header>
        @include('header')
    </header>
    <div class="container">
        <div id="main_content_wrap">
            <div id="content_wrap">
                <!--中央メニューのラップ-->
                <div class="post_content_wrap">
                    <section class="post_section_wrap">
                        <div class="post_info_wrap">
                            <!--投稿者情報を記載(アイコンを追加したらよさそう)-->
                            <div class="flex_space_between">
                                <div class="flex post_info">
                                    {{-- <a href="/profile/{{ $post->user->id }}"><img class="user_image"
                                            src="{{ asset('image/' . $post->user->profile_image) }}" alt="">
                                        <!--プロフ画像追加-->
                                    </a> --}}
                                    <a href="/profile/{{ $post->user->id }}">
                                        <p class="user_id"><span>@</span>{{ $post->user->name }}
                                    </a></p>
                                </div>
                                <div class="report_wrap tententen_wrap">
                                    <i class="fa-solid fa-ellipsis"></i>
                                </div>
                                <div id="report_menu_wrap">
                                    <div class="report_menu">
                                        @auth
                                            @if (Auth::user()->id === $post->user_id)
                                                <button type="button"
                                                    onclick="location.href='/posts/edit/{{ $post->id }}'">編集</button>
                                                <div class="profile_menu_under_bar"></div>
                                                <form method="POST" action="{{ route('delete', $post->id) }}"
                                                    onSubmit="return checkDelete()">
                                                    @csrf
                                                    <button type="submit">削除</button>
                                                </form>
                                            @else
                                                <a href="/report">報告</a>
                                            @endif
                                        @endauth
                                        @guest
                                            <a href="/report">報告</a>
                                        @endguest
                                        <!--<div class="profile_menu_under_bar"></div>アンダーバー-->

                                    </div>
                                </div>
                            </div>
                            <div class="post_info flex created_post">
                                <p class="created_at_p">投稿日 <time
                                        datetime="{{ $post->created_at }}">{{ $post->created_at->format('Y年m月d日') }}</time>
                                </p>
                                <p>更新日 {{ $post->updated_at->format('Y年m月d日') }}</p>
                            </div>
                        </div>
                        <div class="post_info post_title_wrap">
                            <div class="post_title">
                                <h1 class="post_detail_h1">{{ $post->title }}</h1>
                            </div>
                        </div>
                        <section class="combo_recipe">
                            <h2 class="post_detail_h2 detail_advise_h2">本文</h2>
                            <div>
                                <h3 class="box">{{ $post->body}}</h3>
                            </div>
                            <br><br><br>
                        </section>
                </section>
                {{-- <section class="post_section_wrap">
                    <div>
                        <h2 class="post_comment_h2">コメント</h2>
                    </div>
                    <div class="commnet_form_wrap">
                        <div id="comment-article-{{ $post->id }}">
                            {{-- @if ($post->comments == '[]')
                                <!--コメントがない場合は下の文字を表示させる-->
                                <div class="post_info">
                                    <p>この記事にコメントはありません。</p>
                                </div>
                            @endif --}}
                            {{-- @foreach ($post->comments as $comment)
                                <div class="comment_list">
                                    <div class="post_info flex_space_between created_post">
                                        <!--aタグでユーザー情報に飛べるように設定(OK)-->
                                        <!--削除ボタン通報ボタンを設定したい-->
                                        <div class="flex comment_user_wrap">
                                            <a href="/profile/{{ $comment->user->id }}"><img class="user_image"
                                                    src="{{ asset('image/' . $comment->user->profile_image) }}"
                                                    alt=""></a>
                                            <!--プロフ画像追加-->
                                            <p class="user_id"><a
                                                    href="/profile/{{ $comment->user->id }}"><span>@</span>{{ $comment->user->name }}</a>
                                            </p>
                                        </div>
                                        <div class="flex">
                                            <p class="comment_time">{{ $post->created_at->format('Y-m-d h:m') }}</p>
                                            <div class="comment_icon_wrap">
                                                @if ($comment->user->id == Auth::id())
                                                    <!--コメント投稿ユーザーと見てるユーザーが同じなら削除ボタンを設ける-->
                                                    <a onclick="return checkDelete2()" class="delete-comment"
                                                        data-remote="true" rel="nofollow" data-method="delete"
                                                        href="/comments/{{ $comment->id }}"><i
                                                            class="fa-solid fa-trash-can"></i></a>
                                                @else
                                                    <a class="delete-comment" data-remote="true" rel="nofollow"
                                                        data-method="delete" href=""><i
                                                            class="fa-solid fa-ban"></i></a>
                                                    <!--通報についてのリンクを春-->
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="comment_wrap">
                                    <span>{{ $comment->comment }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!--ログインしてコメントしよう画像を追加する予定-->
                    @guest
                        <div class="guest_comment_form">
                            <form id="new_comment" action="/post/{{ $post->id }}/comments" method="POST">
                                @csrf
                                <input value="{{ $post->id }}" type="hidden" name="post_id" />
                                <input value="{{ Auth::id() }}" type="hidden" name="user_id" />
                                <textarea class="comment_textarea" placeholder="" autocomplete="off" type="text" name="comment"></textarea>
                                <button type="submit" class="delete_button">▶投稿する</button>
                            </form>
                        </div>
                    @endguest
                    @auth
                        <div class="comment_form">
                            <form id="new_comment" action="/post/{{ $post->id }}/comments" method="POST">
                                @csrf
                                <input value="{{ $post->id }}" type="hidden" name="post_id" />
                                <input value="{{ Auth::id() }}" type="hidden" name="user_id" />
                                <textarea class="comment_textarea" placeholder="" autocomplete="off" type="text" name="comment"></textarea>
                                <button type="submit" class="delete_button">▶投稿する</button>
                            </form>
                        </div>
                    @endauth
                </section> --}}
            <script>
                function checkDelete() {
                    if (window.confirm('この記事を削除してよろしいですか？削除した投稿は復旧できません。')) {
                        return true;
                    } else {
                        return false;
                    }
                }

                function checkDelete2() {
                    if (window.confirm('このコメントを削除してよろしいですか？')) {
                        return true;
                    } else {
                        return false;
                    }
                }
            </script>
        </div>
    </div>
    </div>
    </div>
    </div>
    <footer>
        @include('footer')
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
</body>

</html>
