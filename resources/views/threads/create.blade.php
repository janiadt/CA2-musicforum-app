{{-- Need to change the extends to "myapp", since breeze added its own app layout --}}
@extends('layouts.myapp')

@section('content')
    <h3 class="text-center">Create Thread</h3>
    {{-- Here I'm routing the form action to the songs.store page. This will basically lead us to that page when the form is submitted, with the post method, which carries data along. --}}
    <form action="{{ route('threads.store', Illuminate\Support\Facades\Auth::user()->id) }}" method="post">
        {{-- Csrf ensures that we have a secure token which you will not be able to submit a form without --}}
        @csrf
        <div class="form-group">
            <label for="title">Thread Title</label>
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
            <label for="artist">Thread Body</label>
            {{-- Fixed textarea --}}
            <textarea rows="30" cols="50" style="resize:none" name="body" id="body" class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}" value="{{ old('body')}}" placeholder="Enter Text"></textarea>
            @if($errors->has('body')) {{-- <-check if we have a validation error --}}
                <span class="invalid-feedback">
                    {{ $errors->first('body') }} {{-- <- Display the First validation error --}}
                </span>
            @endif
        </div>
        <div class="form-group">
            <label for="album">Music Category</label>
            <select name="music_category" class="form-control {{ $errors->has('music_category') ? 'is-invalid' : '' }}" value="{{ old('music_category') }}">
                {{-- For each model category, show an option to select it --}}
                @foreach (App\Models\Thread::arr() as $a)
                <option value = "{{$a}}">{{$a}} </option>
                @endforeach
            </select>
            @if($errors->has('music_category')) 
                <span class="invalid-feedback">
                    {{ $errors->first('music_category') }} 
                </span>
            @endif
        </div>
        <div class="form-group">
            <label for="date">Image</label>
            {{-- Image form here --}}
            <input type="text" name="image" id="image" class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}" value="{{ old('image') }}">
            @if($errors->has('image')) 
                <span class="invalid-feedback">
                    {{ $errors->first('image') }} 
                </span>
            @endif
        </div>
        {{-- This is a button that will let us submit the form, which will then inact the form action --}}
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection