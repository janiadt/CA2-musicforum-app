<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SongController;
use App\Http\Controllers\ThreadController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Here we will import all of the controllers.

// Modifying the root route so that it redirects us to the index page
Route::get('/', function () {
    return redirect()->route('songs.index');
});

// Since the resources needed to create a set of CRUD actions are always similar, laravel has added a resource route, which will create all the needed CRUD routes automatically.
Route::resource('songs', SongController::class);

// We get make a new route and pass the song ID and a new "favorite" url. We then call the favorite method in the song controller.
Route::get('songs/{song}/favourite', [SongController::class, 'favourite'])->name('songs.favourite');

// Below is the route to get the dashboard of the user side of the website. It uses the authentication middleware, which is run before the route is finished.
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
// Creating the resource routes for the threads table
Route::resource('threads', ThreadController::class)->except([
    // Removing the edit route from the list, so I can create my own.
    'edit',
    'store'
]);

Route::get('/threads/{id}/edit/', [ThreadController::class, 'edit'])->name('threads.edit');
// Passing the user's id to the store method, which lets us access it in the controller.
Route::post('/threads/{userid}', [ThreadController::class, 'store'])->name('threads.store');

Route::get('/subscribe', [ProfileController::class, 'subscribe'])->name('profile.subscribe');

// In the auth middleware, we have a few profile routes, that lead to the edit, update and destroy pages. (if the user is authenticated)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
