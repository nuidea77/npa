<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class NewsController extends Controller
{
    public function index() {
        $post = Post::with('translations')->where([['status', '=','PUBLISHED']])->orderBy('created_at', 'desc')->paginate(12);
        return view('post.index')
        ->with('post', $post);
    }
    public function view($id)
    {
        $data = Post::with('translations')->where('id',  $id)->first();
        return view('post.view')
        ->with('data', $data);
    }
}
