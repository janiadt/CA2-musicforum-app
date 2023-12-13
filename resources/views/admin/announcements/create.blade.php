{{-- Need to change the extends to "myapp", since breeze added its own app layout --}}
@extends('layouts.myapp')

@section('content')
<form enctype="multipart/form-data" action="{{ route('admin.announcements.store') }}" method="post">
    {{-- Csrf ensures that we have a secure token which you will not be able to submit a form without --}}
    @csrf
    {{-- We also need a put method here, since HTML forms dont have it --}}
    <div class="form-group">
        <label for="title">Announcement Title</label>
        {{-- Creating input types for each table variable --}}
        <input type="text" name="title" id="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" value="{{ old('title')}}" placeholder="Enter Title">
        {{-- Error feedback --}}
        @if($errors->has('title'))
            <span class="invalid-feedback">
                {{ $errors->first('title') }}
            </span>
        @endif
    </div>
    {{-- Body value input. Here we'll need a textarea for the input --}}
    <div class="form-group">
        <label for="body">Announcement Body</label>
        <input type="textarea" name="body" id="body" class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}" value="{{ old('body')}}" placeholder="Enter Body">
        @if($errors->has('body')) {{-- <-check if we have a validation error --}}
            <span class="invalid-feedback">
                {{ $errors->first('body') }} {{-- <- Display the First validation error --}}
            </span>
        @endif
    </div>
    {{-- This is a button that will let us submit the form, which will then inact the form action --}}
    <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection