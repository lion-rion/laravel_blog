@extends('layout')
@section('title', 'ブログ投稿フォーム')
@section('content')

@if (session('err_msg'))
    <p class="text-danger">{{ session('err_msg')  }}</p>
@endif
<div class="post_section_wrap">
    <div class="post_form_section">
        <h2 class="post_form_h2">ブログ投稿</h2>
        <form method="POST" action="{{ route('store') }}" onSubmit="return checkSubmit()">
        @csrf
        @if ($errors->has('title'))
        <p class="validation">{{$errors->first('title')}}</p>
        @endif
        <br>
        <div class="post_info">
            <p class="post_form_upper_p">タイトル</p>
            <input
                class="form_input_long"
                name="title"
                placeholder="Next.jsの基本的な使い方"
                value="{{ old('title') }}">
        </div>
        @if ($errors->has('body'))
        <p class="validation">{{$errors->first('body')}}</p>
        @endif
        <div class="post_info">
                <p class="post_form_upper_p">本文</p>
                <textarea
                style="height: 300px"
                class="form_input_long h-96"
                name="body"
                value="">{{ old('body')}}
                </textarea>
        </div>
        <div class="flex">
            <button type="submit" class="submit_button">
                投稿する
            </button>
        </div>
        </form>
    </div>
</div>
<script>
function checkSubmit(){
if(window.confirm('投稿してよろしいですか？')){
    return true;
} else {
    return false;
}
}
</script>
@endsection