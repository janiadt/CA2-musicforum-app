<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thread;
use App\Models\User;
use Auth;

class ThreadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Passing in request data into method, to gain access to url parameter
        // Getting url param that we requested
        $sortByMethodParam = $request->query('sortBy');
        // It's valid if its present in the url or if we passed in views as param. This stops the server from processing an invalid/malicious string
        $isValid = $sortByMethodParam !== null && $sortByMethodParam === 'views';
        // If the URL param is valid, we make the sortByMethod the desired parameter (view in this case). We default to created_at
        $sortByMethod = $isValid ? $sortByMethodParam : 'created_at';
        // The threads array is then ordered by the validated URL param
        $threads = Thread::orderBy($sortByMethod, 'desc')->paginate(20);
        // Returning view with threads array
        return view('threads.index', [
            'threads' => $threads
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Returning the create view
        return view('threads.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Getting the current logged in user id
        $user_id = Auth::user()->id;
        // Validation rules for my threads table
        $rules = [
            'title' => 'required|string|min:1|max:255',
            'body'  => 'required|string|min:3|max:10000',
            // This line validates enum values
            'music_category'  => 'required|in:Pop,Rock,Jazz,EDM,Country,Punk Rock,Indie,Progressive Rock,Dance,Disco',
            'image'  => 'nullable|image'
        ];

        $request->validate($rules);
        // New thread intance. Adding the validated request data to the new thread table.
        $thread = new Thread;
        $thread->title = $request->title;
        $thread->body = $request->body;
        $thread->music_category = $request->music_category;
        $thread->image = $request->image;
        $thread->user_id = $user_id;
        $thread->save(); // This new song class now has a new array of data. It's now calling the save function.
        return redirect()
            ->route('threads.index')
            ->with('status','Created a new Thread!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Returning thread view with thread id
        $thread = Thread::findOrFail($id);
        // Updating the views entity in the thread column every time this function is calledi
        $thread->update(['views' => $thread->views + 1]);
        return view('threads.show', [
            'thread' => $thread
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    // 
    public function edit(string $id)
    {
        $thread = Thread::findOrFail($id);
        // Making sure the user is the person accessing the edit. If not, just send them to the index
        if ($thread->user_id === Auth::user()->id || Auth::user()->hasRole('admin')){
            return view('threads.edit', [
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
            'title' => 'required|string|min:1|max:255',
            'body'  => 'required|string|min:3|max:10000',
            // This line validates enum values
            'music_category'  => 'required|in:Pop,Rock,Jazz,EDM,Country,Punk Rock,Indie,Progressive Rock,Dance,Disco',
            'image'  => 'nullable|image'
        ];

        $request->validate($rules);
        // New thread intance. Adding the validated request data to the new thread table.
        $thread = Thread::findOrFail($id);
        $thread->title = $request->title;
        $thread->body = $request->body;
        $thread->music_category = $request->music_category;
        $thread->image = $request->image;
        $thread->user_id = $thread->user_id;
        $thread->save(); // This new song class now has a new array of data. It's now calling the save function.
        return redirect()
            ->route('threads.show', $thread->id)
            ->with('status','Updated the Thread!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $thread = Thread::findOrFail($id);
        // If the user is the person who made the thread, or if they are an admin user, they can delete the post.
        if ($thread->user_id === Auth::user()->id || Auth::user()->hasRole('admin')){
            $thread->delete();
            // Redirecting to the index and giving our flash message a status key
            return redirect()
                ->route('threads.index')
                ->with('status', 'Deleted the Thread!');
        } else {
            abort(401);
        }
    }
}
