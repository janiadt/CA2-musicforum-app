<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thread;
use Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        // Using the auth middleware
        $this->middleware('auth');
    }

    // This controller will take care of the home page thread display

    public function index(Request $request)
    {

        // Getting the authenticated user
        $user = Auth::user();
        // Making a home variable
        $home = 'home';
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

}
