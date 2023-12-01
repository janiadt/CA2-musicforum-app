{{-- Need to change the extends to "myapp", since breeze added its own app layout --}}
@extends('layouts.myapp')

@section('content')
    <h3 class="text-center">Upload Song</h3>
    {{-- Here I'm routing the form action to the songs.store page. This will basically lead us to that page when the form is submitted, with the post method, which carries data along. --}}
    <form action="{{ route('songs.store') }}" method="post">
        {{-- Csrf ensures that we have a secure token which you will not be able to submit a form without --}}
        @csrf
        <div class="form-group">
            <label for="title">Song Title</label>
            {{-- In this input textbox, we will input the values which will go into our database. The validation errors are accessed with the $errors array. If it has a title error, we output 'is-invalid' --}}
            {{-- If we have already visited this page once and input our form, we can access that old input with the old() helper function --}}
            <input type="text" name="title" id="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" value="{{ old('title') }}" placeholder="Enter Title">
            {{-- If the errors array has a title error, we create a new span that echoes the first object that starts with 'title' --}}
            @if($errors->has('title'))
                <span class="invalid-feedback">
                    {{ $errors->first('title') }}
                </span>
            @endif
        </div>
        {{-- We will essentially copy the first div here for all of our validation form inputs. It's the sam econcept except with minor differences which I will note --}}
        <div class="form-group">
            <label for="artist">Song Artist</label>
            <input type="text" name="artist" id="artist" class="form-control {{ $errors->has('artist') ? 'is-invalid' : '' }}" value="{{ old('artist') }}" placeholder="Enter Artist">
            @if($errors->has('artist')) {{-- <-check if we have a validation error --}}
                <span class="invalid-feedback">
                    {{ $errors->first('artist') }} {{-- <- Display the First validation error --}}
                </span>
            @endif
        </div>
        <div class="form-group">
            <label for="album">Album</label>
            <input type="text" name="album" id="album" class="form-control {{ $errors->has('album') ? 'is-invalid' : '' }}" value="{{ old('album') }}" placeholder="Enter Album">
            @if($errors->has('artist')) 
                <span class="invalid-feedback">
                    {{ $errors->first('artist') }} 
                </span>
            @endif
        </div>
        <div class="form-group">
            <label for="date">Date Published</label>
            {{-- Date form input here --}}
            <input type="date" name="date" id="date" class="form-control {{ $errors->has('date') ? 'is-invalid' : '' }}" value="{{ old('date') }}">
            @if($errors->has('date')) 
                <span class="invalid-feedback">
                    {{ $errors->first('date') }} 
                </span>
            @endif
        </div>
        <div class="form-group">
            <label for="duration">Duration</label>
            {{-- Here I will use the decimal inputmode --}}
            <input type="text" inputmode="decimal" name="duration" id="duration" class="form-control {{ $errors->has('duration') ? 'is-invalid' : '' }}" value="{{ old('duration') }}" placeholder="00.00">
            @if($errors->has('duration')) 
                <span class="invalid-feedback">
                    {{ $errors->first('duration') }} 
                </span>
            @endif
        </div>
        <div class="form-group">
            <label for="link">Youtube Link</label>
            <input type="text" name="link" id="link" class="form-control {{ $errors->has('link') ? 'is-invalid' : '' }}" value="{{ old('link') }}">
            @if($errors->has('link')) 
                <span class="invalid-feedback">
                    {{ $errors->first('link') }} 
                </span>
            @endif
        </div>
        {{-- This is a button that will let us submit the form, which will then inact the form action --}}
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection