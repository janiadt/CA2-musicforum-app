{{-- Here you can see that we are extending the app from the layouts folder. This means that everything in there is now in here. --}}
@extends('layouts.myapp')
{{-- I am then replacing the content section in the original app file with this current content. --}}
@section('content')
{{-- The page only displays the songs if the user is a subscriber --}}
    @auth
    @if (Auth::user()->membership === 'subscriber')
    <h2 class="text-center">All Songs</h2>
    {{-- Moving the create song button to the index body --}}
    <a href="{{route('songs.create')}}" class="btn btn-primary px-2">Submit Song</a> 
    <ul class="list-group py-3 mb-3">
        {{-- Using a for loop, I creare a list object for each song object in the $songs array. --}}
        @forelse($songs as $song)
            <li class="list-group-item list-group-item-primary my-2">
                {{-- Using the {{}} brackets, I'm passing in php variables that are unique to each song --}}
                <h5>{{ $song->title }}</h5>
                <p>{{ ($song->artist) }}</p>
                {{-- We get a users array from the pivot table associated with the songs'id. We then iterate through the array, and display a name for each user. --}}
                @forelse($song->users as $user)
                  <p>{{$user->name}}</p>
                @empty
                  <p>No Users Favorited</p>
                @endforelse
                {{-- The diffForHumans function makes the date more readable. --}}
                <small class="float-right">{{ $song->created_at->diffForHumans() }}</small>
                {{-- This will route to the show file, while will show more details about the song --}}
                <a href="{{route('songs.show',$song->id)}}" class="text-dark">More Details</a>
                {{-- The favourite button uses the favourite route and passes the song id to the favourite method. --}}
                <a class="btn btn-warning float-end" id="favorite-button" href="{{route('songs.favourite',$song->id)}}">★</a>
            </li>
        @empty
            <h4 class="text-center">No Songs Found!</h4>
        @endforelse
    </ul>
    {{-- Pagination links --}}
    <div class="d-flex justify-content-center">
        {{ $songs->links() }}
    </div>
    @else 
    {{-- Display this if the user isn't a subscriber --}}
    <div class="container my-5">
      <div class="justify-content-center position-relative p-5 text-center text-muted border border-dashed rounded-5" style="background-color: #6672db;">
        <h1 class="text-white mt-5">Become a subscriber to add and edit songs!</h1>
        <p class="col-lg-6 mx-auto mb-4 text-white">
          Subscribers are allowed to submit music to further discussions. You also get a shiny badge on your profile!
        </p>
        <a href="{{route('profile.subscribe')}}" class="btn btn-primary px-5 mb-5">
          Subscribe (3.99$/month)
        </a>
      </div>
    </div>
    @endif
    
    @endauth

    {{-- In the case that a guest visits this page, we will add a button to go to the register page --}}
    @guest
    <div class="container my-5">
        <div class="justify-content-center position-relative p-5 text-center text-muted border border-dashed rounded-5" style="background-color: #6672db;">
          <h1 class="text-white mt-5">Want to add songs and join the discussion? Register now!</h1>
          <p class="col-lg-6 mx-auto mb-4 text-white">
            If you want to submit your favorite songs and have discussions about them, you should register and become a member! Here you can create threads, make posts, and rate music!
          </p>
          <a href="{{route('register')}}" class="btn btn-primary px-5 mb-5">
            Register
          </a>
        </div>
      </div>
    @endguest
    
@endsection