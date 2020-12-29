<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PostController extends Controller {
  public function index() {
    $user = Auth::user();
    $posts=Post::where(['user_id'=>$user->id])->paginate('5');
//    dd($posts);
   return view('post.index', ['posts' => $posts]);
  }

  public function store(Request $request) {
    $user = Auth::user();
    $post = new Post();
    $post->body = $request->body;
    $post->user_id = $user->id;
    $post->save();

    $email_data = array(
      'name' => $user->username,
      'email' => $user->email,
      'post' => $request->body
    );

    // send email with the template
    Mail::send('emails.Confirmation', $email_data, function ($message) use ($email_data) {
      $message->to($email_data['email'], $email_data['name'])
        ->subject('Confirmation Post');
    });

    $posts=Post::where(['user_id'=>$user->id])->paginate('5');

    return view('post.index', ['posts' => $posts]);
  }
}
