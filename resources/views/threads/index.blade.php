@extends('layouts.myapp')
@section('content')
{{-- Displaying all threads created by user --}}
    @auth
    <h2 class="text-center">Threads</h2>
    <a href="{{route('threads.create')}}" class="btn btn-primary px-2">Create Thread</a>
    {{-- If the URL param that we get with the request method is "views", we display the default button --}}
    @if(request()->sortBy === 'views')
    <a class="most-views btn btn-primary px-1 float-end" href="{{route('threads.index')}}"> Default Sort</a>
    @else
    {{-- Else, display the sorting button --}}
    <a class="most-views btn btn-primary px-1 float-end" href="{{route('threads.index',['sortBy' => 'views'] )}}">Most Viewed</a>
    @endif

    {{-- Thread for loop. --}}
      {{-- Created a table for the forum, as this seems more useful than a list --}} 
      <table class="table table-bordered mt-3" id="normal-table" style="table-layout:auto">
        <thead class="table-primary">
          <tr>
            <th scope="col" style="width:60%" class="p-2">Thread Title</th>
            <th scope="col" class="p-2">Created By</th>
            <th scope="col" class="p-2">Post Count</th>
            <th scope="col" class="p-2">Views</th>
          </tr>
        @forelse($threads as $thread)
        </thead>
          <tbody>
            <tr>
              {{-- Link to show page --}}
              <td class="p-3"><a href="{{route('threads.show',$thread->id)}}" id="counter" class="link-underline link-underline-opacity-0 link-underline-opacity-100-hover text-black">{{$thread->title}}</a></td>
              {{-- Link to user page --}}
              <td class="p-3 pb-1"><a href="#" class="link-underline link-underline-opacity-0 link-underline-opacity-100-hover text-black row">{{$thread->users->name}}</a>
              <small style="color:#6672db">{{$thread->created_at->diffForHumans()}}</small></td>
              <td class="p-3">0</td>
              {{-- The updating views column is displayed here --}}
              <td class="p-3" >{{$thread->views}}</td>
            </tr>
          </tbody>
        @empty
          <h4 class="text-center">No Threads in this category!</h4>
        @endforelse
      </table>

      {{-- Most viewed threads --}}

    {{-- Pagination links --}}
    <div class="d-flex justify-content-center">
        {{ $threads->links() }}
    </div>
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