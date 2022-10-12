<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Http\Controllers\Auth;

class PostController extends Controller
{
    //
    public function index()
    {
        //日付順に並べる
        $posts = Post::orderBy('created_at', 'asc')->paginate(5);
        return view('posts.index',[
            'posts' => $posts
        ]);
    }

    //ブログ詳細を表示する
    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post
        ]);
    }

    //ブログ投稿画面を表示
    public function showCreate(){
        return view('posts.form');
    }

    //ブログ登録
    public function exeStore(Request $request){

        //ブログデータを受け取る
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);
        $inputs = $request->all();
        
        Post::create($inputs);

        return redirect('/');
    }

     //ブログ編集フォームを表示する 引数はid
     public function showEdit($id){
        $post = Post::find($id);
        if(\Auth::user()->id == $post->user_id)
        {
        return view('posts.edit',['post' => $post]);
        }
        else
        {
        abort(403);
        }
    }

    public function exeUpdate(Request $request){

        $inputs = $request->all();
        
        $post = Post::find($inputs['id']);
        $post->fill([
            'title' => $inputs['title'],
            'body' => $inputs['body'],
        ]);
        $post->save();
        return redirect('/');
    }

     //ブログ削除フォームを表示する 引数はid
     public function exeDelete($id){
        $post = Post::find($id);
        if(\Auth::user()->id == $post->user_id)
        {
        Post::destroy($id);
        }
        else
        {
        abort(403);
        }
        return redirect('/'); 
    }
    public function showComing(){
        return view('posts.coming');
    }
}
