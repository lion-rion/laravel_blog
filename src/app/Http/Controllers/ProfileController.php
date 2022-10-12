<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    //
    public function user_profile($id) {
        $user = User::find($id);
        $user->post_count = Post::where('user_id', $user->id)->get()->count();
        if($user->post_count > 1){
            $posts = Post::where('user_id', $id)->get();
        } else{
            $posts = Post::where('user_id', $id)->first();
        }
        return view('user.profile', [
            'user' => $user, 
            'posts' => $posts
        ]);
    }
}
