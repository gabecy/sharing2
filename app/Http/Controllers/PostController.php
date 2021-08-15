<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostUpdateRequest;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class PostController extends Controller
{
    public function update(Post $post,PostUpdateRequest $request)
    {


        // $validator = Validator::make($request->all(),[
        //     'post_text' => 'required',
        // ]);

        // if($validator->fails()){
        //     return back()
        //         ->withInput()
        //         ->withErrors($validator);
        // }

        $post->update($request->all());

        foreach($post->authors as $author){
            $words_count = 0;
            foreach($author->posts as $posts){
                $words_count += str_word_count($posts->post_text);
            }
            $author->words_count = $words_count();
        }

        $admin = User::where('role','admin')->first();
        if($admin){
            Mail::send('emails.post_updated',['post' => $post], function($m) use ($admin) {
                $m->from('hello@app.com','Your Application');
                $m->to($admin->email,$admin->name)->subject('Post updated');
            });

            return redirect()->route('admin.post.index');
        }
    }















    // public function update($post_id,Request $request)
    // {
    //     $post = Post::find($post_id);
    //     if(!$post){
    //         abort(404);
    //     }

    //     $validator = Validator::make($request->all(),[
    //         'post_text' => 'required',
    //     ]);

    //     if($validator->fails()){
    //         return back()
    //             ->withInput()
    //             ->withErrors($validator);
    //     }

    //     $post->update($request->all());

    //     foreach($post->authors as $author){
    //         $words_count = 0;
    //         foreach($author->posts as $posts){
    //             $words_count += str_word_count($posts->post_text);
    //         }
    //         $author->words_count = $words_count();
    //     }

    //     $admin = User::where('role','admin')->first();
    //     if($admin){
    //         Mail::send('emails.post_updated',['post' => $post], function($m) use ($admin) {
    //             $m->from('hello@app.com','Your Application');
    //             $m->to($admin->email,$admin->name)->subject('Post updated');
    //         });

    //         return redirect()->route('admin.post.index');
    //     }
    // }
}
