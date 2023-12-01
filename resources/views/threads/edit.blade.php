@extends('layouts.myapp')

@section('content')
    <h3 class="text-center">Edit Thread</h3>
    {{-- Routing to threads update method, passing thread id. --}}
    <form action="{{ route('threads.update', $thread->id) }}" method="post">
        {{-- Csrf ensures that we have a secure token which you will not be able to submit a form without --}}
        @csrf
        {{-- We also need a put method here, since HTML forms dont have it --}}
        @method('PUT')
        <div class="form-group">
            <label for="title">Thread Title</label>
            {{-- Creating input types for each table variable --}}
            <input type="text" name="title" id="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" value="{{ old('title') ? : $thread->title }}" placeholder="Enter Title">
            {{-- Error feedback --}}
            @if($errors->has('title'))
                <span class="invalid-feedback">
                    {{ $errors->first('title') }}
                </span>
            @endif
        </div>
        {{-- Body value input. Here we'll need a textarea for the input --}}
        <div class="form-group">
            <label for="body">Thread Body</label>
            <input type="textarea" name="body" id="body" class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}" value="{{ old('body')  ? : $thread->body }}" placeholder="Enter Body">
            @if($errors->has('body')) {{-- <-check if we have a validation error --}}
                <span class="invalid-feedback">
                    {{ $errors->first('body') }} {{-- <- Display the First validation error --}}
                </span>
            @endif
        </div>
        <div class="form-group">
            <select name="music_category" class="form-control {{ $errors->has('music_category') ? 'is-invalid' : '' }}" value="{{ old('music_category') ? : $thread->music_category }}">
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
            </select>
            @if($errors->has('category')) 
                <span class="invalid-feedback">
                    {{ $errors->first('category') }} 
                </span>
            @endif
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            {{-- Date form input here --}}
            <input type="text" name="image" id="image" class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}" value="{{ old('image')  ? : $thread->image }}">
            @if($errors->has('image')) 
                <span class="invalid-feedback">
                    {{ $errors->first('image') }} 
                </span>
            @endif
        </div>
        {{-- This is a button that will let us submit the form, which will then inact the form action --}}
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection