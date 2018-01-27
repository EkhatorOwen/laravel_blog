<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;

class BlogController extends Controller
{
    public function getIndex()
    {
        $posts = Post::paginate(2);

        return view('blog.index')->with('posts',$posts);
    }
    public function getSingle($slug)
    {
      $post = Post::where('slug','=', $slug)->first(); //it says get the first one and display as a single object instead of collection

        return view('blog.single')->with('post',$post);
    }
}
