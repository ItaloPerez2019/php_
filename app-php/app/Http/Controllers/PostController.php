<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller {
  public function index() {
    $user = Auth::user();
    $posts = [];
    if ($user)
    $posts = $user->posts;
    return view('post.index', ['posts' => $posts]);
  }

  public function store(Request $request) {
    $user = Auth::user();
    $post = new Post();
    $post->body = $request->body;
    $post->user_id = $user->id;
    $post->save();

    $posts = $user->posts;
    return view('post.index', ['posts' => $posts]);
  }
}
