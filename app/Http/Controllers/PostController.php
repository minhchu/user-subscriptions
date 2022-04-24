<?php

namespace App\Http\Controllers;

use App\Events\PostCreated;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'website_id' => 'required|exists:websites,id',
        ]);

        $post = Post::create($data);

        PostCreated::dispatch($post);

        return $post;
    }
}
