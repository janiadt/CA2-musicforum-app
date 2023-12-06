{{-- Need to change the extends to "myapp", since breeze added its own app layout --}}
@extends('layouts.myapp')

@section('content')
    <h3 class="text-center">Upload Post</h3>
    {{-- Here I'm routing the form action to the songs.store page. This will basically lead us to that page when the form is submitted, with the post method, which carries data along. --}}
    <form action="{{ route('posts.store', $thread->id) }}" method="post">
        {{-- Csrf ensures that we have a secure token which you will not be able to submit a form without --}}
        @csrf
        <div class="form-group">
            <label for="title">Post Body</label>
            {{-- In this input textbox, we will input the values which will go into our database. The validation errors are accessed with the $errors array. If it has a title error, we output 'is-invalid' --}}
            {{-- If we have already visited this page once and input our form, we can access that old input with the old() helper function --}}
            <textarea name="body" id="body" class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}" value="{{ old('body') }}" placeholder="Enter Text"></textarea>
            {{-- If the errors array has a title error, we create a new span that echoes the first object that starts with 'title' --}}
            @if($errors->has('body'))
                <span class="invalid-feedback">
                    {{ $errors->first('body') }}
                </span>
            @endif
        </div>
        {{-- This is a button that will let us submit the form, which will then inact the form action --}}
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection