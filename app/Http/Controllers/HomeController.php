<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thread;
use Auth;

class HomeController extends Controller
{
    // This controller will take care of the home page thread display

    public function index(Request $request)
    {

        // Getting the authenticated user
        $user = Auth::user();
        // Making a home variable
        $home = 'user.home';
        // Making a threads variable
        $threads = Thread::where('user_id', Auth::id())->paginate(20);
        // If the user has the admin role in the roles table
        if($user->hasRole('admin')){
            // Change the variable to admin home
            $home = 'admin.home';
            $threads = Thread::orderBy('created_at', 'desc')->paginate(20);
        }

        // If the user has a user role
        else if($user->hasRole('user')){
            // Change the home to user home
            $home = 'user.home';
        }

        // Getting every thread that was posted by the current user
        
        // Returning view with threads array
        return view($home, [
            'threads' => $threads
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    // 
    public function edit(string $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
    }
}
