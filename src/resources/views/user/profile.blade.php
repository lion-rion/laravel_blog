@extends('layout')
@section('title','プロフィール') <!--タイトルはコンボのタイトルに設定するとイイかも？？-->
@section('content')
<!--中央メニューのラップ-->
<div class="post_content_wrap">
    <section class="profile_section_wrap">
        <div class="profile_wrap">
            <div class="profile_card">
                <p class="profile_username"><span>@</span>{{ $user->name }}</p>
            </div>
        </div>
    </section>
</div>
<div>
    <div class="sort_form_wrap">
        <div class="flex sort_button_container">
            <!--おすすめ順の設定が終わってないです-->
            <div class="sort_button_wrap">
                <p class="sort_button_on">{{$user->name}}さんの投稿</p>
            </div>
        </div>
    </div>
    @if($user->posts->count() > 1)
    @foreach($posts as $post)
        <a class="post_section_link" href="/post/{{ $post->id }}">
        <section class="post_section_wrap">
            <div class="post_info post_title_wrap">
                <div class="post_title">
                    <h2 class="post_title_h2">{{ $post->title }}</h2>
                </div>
            </div>
            <div class="post_info combo_content_wrap">
                <div class="combo_content">
                    <p class="combo_content_p">{{ $post->body }}</p>
                </div>
            </div>
        </section>
        </a>
    @endforeach
    @else
    <a class="post_section_link" href="/post/{{ $posts->id }}">
        <section class="post_section_wrap">
            <div class="post_info post_title_wrap">
                <div class="post_title">
                    <h2 class="post_title_h2">{{ $posts->title }}</h2>
                </div>
            </div>
            <div class="post_info combo_content_wrap">
                <div class="combo_content">
                    <p class="combo_content_p">{{ $posts->body }}</p>
                </div>
            </div>
        </section>
        </a>
    @endif
@endsection