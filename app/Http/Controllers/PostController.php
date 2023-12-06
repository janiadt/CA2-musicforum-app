<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Thread;

class PostController extends Controller
{
    public function create(string $threadid)
    {
        // I'm finding the thread here again so I can send the data in the URL to the store method
        $thread = Thread::findOrFail($threadid);
        // Returning the create view
        return view('posts.create', [
            'thread' => $thread
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $threadid)
    {
        // Getting the current logged in user id
        $user_id = Auth::user()->id;
        
        // Validation rules for my threads table
        $rules = [
            'body'  => 'required|string|min:3|max:10000',
            // Checking if the ID's we're receiving are integers
            'user_id'  => 'integer',
            'thread_id'  => 'integer'
        ];

        $request->validate($rules);
        // New thread intance. Adding the validated request data to the new thread table.
        $post = new Post;
        $post->body = $request->body;
        $post->user_id = $user_id;
        $post->thread_id = $threadid;
        $post->save();
        return redirect()
            ->route('threads.index')
            ->with(['status' => 'Created the Post!',]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Returning post view with post id
        $post = Post::findOrFail($id);
        return view('posts.show', [
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    // 
    public function edit(string $id)
    {
        $post = Post::findOrFail($id);
        // Finding the thread by the posts's thread_id, since we already know it
        $thread = Thread::findOrFail($post->thread_id);
        // Making sure the user is the person accessing the edit. If not, just send them an error
        if ($post->user_id === Auth::user()->id || Auth::user()->hasRole('admin')){
            return view('posts.edit', [
                'post' => $post,
                'thread' => $thread
            ]);
        } else {
            // Sending an error if the user attempts to edit a thread they don't own
            abort(401);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validation rules for my threads table
        $rules = [
            'body'  => 'required|string|min:3|max:10000',
            'user_id'  => 'integer',
            'thread_id'  => 'integer'
        ];

        $request->validate($rules);
        // New post instance that automatically updated the thread id and user id
        $post = Post::findOrFail($id);
        $post->body = $request->body;
        $post->user_id = $post->user_id;
        $post->thread_id = $post->thread_id;
        $post->save();
        return redirect()
            ->route('threads.show', $post->thread_id)
            ->with('status','Updated the Post!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        // If the user is the person who made the thread, or if they are an admin user, they can delete the post.
        if ($post->user_id === Auth::user()->id || Auth::user()->hasRole('admin')){
            $post->delete();
            // Redirecting to the index and giving our flash message a status key
            return redirect()
                ->route('threads.index')
                ->with('status', 'Deleted the Post');
        } else {
            abort(401);
        }
    }
}
