@extends('layout')
@section('title', 'ブログ編集')
@section('content')

@if (session('err_msg'))
    <p class="text-danger">{{ session('err_msg')  }}</p>
@endif
<div class="post_section_wrap">
    <div class="post_form_section">
        <h2 class="post_form_h2">ブログ編集</h2>
        <br>
        <form method="POST" action="{{ route('update') }}" onSubmit="return checkSubmit()">
        @csrf
        <input type="hidden" name="id" value="{{$post->id}}">
        @if ($errors->has('title'))
        <p class="validation">{{$errors->first('title')}}</p>
        @endif
        <div class="post_info">
            <p class="post_form_upper_p">タイトル</p>
            <input
                class="form_input_long"
                name="title"
                placeholder="Next.jsの基本的な使い方"
                value="{{ $post->title }}">
        </div>
        @if ($errors->has('body'))
        <p class="validation">{{$errors->first('body')}}</p>
        @endif
        <br>
        <div class="post_info">
                <p class="post_form_upper_p">本文</p>
                <textarea
                style="height: 300px"
                class="form_input_long h-96"
                name="body"
                placeholder="Next.jsの基本的な使い方"
                value="">{{ $post->body}}
                </textarea>
            </div>
        <div class="flex">
            <button type="submit" class="submit_button">
                更新する
            </button>
        </div>
        </form>
    </div>
</div>
<script>
function checkSubmit(){
if(window.confirm('更新してよろしいですか？')){
    return true;
} else {
    return false;
}
}
</script>
@endsection