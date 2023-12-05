<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Song;
use Auth;

class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // The song controller contains the functions required to make forms for CRUD. We will use this controller to tell Models how to interact with the database.
    public function index()
    {
        // Here I'm telling the Song model to connect to the database and store eight songs with the orderBy method. 
        // The paginate method counts all of the records in the query and then returns them after. It also creates a link for each record that can be accessed.
        $songs = Song::orderBy('created_at', 'desc')->paginate(8);
        // This function then returns the songs.index view. It also passes along some data using the second parameter, which is the $songs array.
        return view('songs.index', [
            'songs' => $songs
        ]);
    }



    // Making a favorite method that will accept a song id
    public function favourite(string $id)
    {
        // We find the song id through the find or fail function
        $song = Song::findOrFail($id);
        // We attach the current authenticated user's ID. If there's already an ID, it's detached before it's attached. This ensures one user can't favorite the same song.
        $song->users()->detach(Auth::id());
        $song->users()->attach(Auth::id());
        
        
        return redirect()
            ->route('songs.index') 
            ->with('status','Favourited a new Song!'); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // If the user is an admin or a subscriber
        if (Auth::user()->hasTheseRoles(['admin', 'subscriber'])){
        // Returning the create view
        return view('songs.create');
        } else {
            abort(401);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //This is where we create the validation rules. Laravel has pre-made helper functions that you can call in the string, to do the validation.
        $rules = [
            'title' => 'required|string|min:1|max:255',
            'artist'  => 'required|string|min:1|max:100',
            'album'  => 'required|string|min:1|max:100',
            'date'  => 'required|date_format:Y-m-d',
            'duration' => 'required|decimal:2|max:999',
            'link' => 'required|unique:songs,link|url:https|string|min:2|max:255'
        ];

        //Validating form data using the previously described rules array.
        $request->validate($rules);
        //Creating an instance of the song class. Replacing the class entities with these new entities we want to store with $request array
        $song = new Song;
        $song->title = $request->title;
        $song->artist = $request->artist;
        $song->album = $request->album;
        $song->date_published = $request->date;
        $song->duration = $request->duration;
        $song->link = $request->link;
        $song->save(); // This new song class now has a new array of data. It's now calling the save function.
        return redirect()
            ->route('songs.index')
            ->with('status','Created a new Song!');
            // use the redirect function which routes us to the index with a new status variable.
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Using the findOrFail method and passing it the song id, then find the id in the database using the model or throw a 404.
        $song = Song::findOrFail($id);
        return view('songs.show', [
            'song' => $song
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Passing our song item to the edit page
        if (Auth::user()->hasTheseRoles(['admin', 'subscriber'])){
        $song = Song::findOrFail($id);
        return view('songs.edit', [
            'song' => $song
        ]);
        } else {
            abort(401);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Same as with the create function, we will need validation rules
        $rules = [
            'title' => 'required|string|min:1|max:255',
            'artist'  => 'required|string|min:1|max:100',
            'album'  => 'required|string|min:1|max:100',
            'date'  => 'required|date_format:Y-m-d',
            'duration' => 'required|decimal:2|max:999',
            'link' => 'required|url:https|string|min:2|max:255'
        ];

        //Validating the form data. Same as the store function
        $request->validate($rules);
        //This part is a bit different to the store method. Our song will be found with the findOrFail method, instead of just created.
        $song = Song::findOrFail($id);
        $song->title = $request->title;
        $song->artist = $request->artist;
        $song->album = $request->album;
        $song->date_published = $request->date;
        $song->duration = $request->duration;
        $song->link = $request->link;
        $song->save(); // One good thing about the save function is that we can use it to either create OR to update
        return redirect()
            ->route('songs.show', $song->id)
            ->with('status','Updated the Song!');
            // Redirecting to the show page with a new status for our flash message.
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Auth::user()->hasTheseRoles(['admin', 'subscriber'])){
        // Here we're using the same findOrFail method, only we're deleting it instead
        $song = Song::findOrFail($id);
        $song->delete();
        // Redirecting to the index and giving our flash message a status key
        return redirect()
            ->route('songs.index')
            ->with('status', 'Deleted the Song!');
        } else {
            abort(401);
        }

    }
}