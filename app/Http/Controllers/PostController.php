<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostUpdateRequest;
use App\Models\Post;

class PostController extends Controller
{
    public function update(Post $post,PostUpdateRequest $request)
    {
        $post->update($request->only('post_text'));
        return redirect()->route('admin.post.index');
    }
}
