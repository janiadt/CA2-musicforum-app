@extends('layouts.myapp')

@section('content')
    <h3 class="text-center">Edit Post</h3>
    {{-- Here I'm routing the form action to the songs.update page with a song id. Very similar to our create form, except we're now using the update method in our controller. --}}
    <form action="{{ route('posts.update', $post->id) }}" method="post">
        {{-- Csrf ensures that we have a secure token which you will not be able to submit a form without --}}
        @csrf
        {{-- We also need a put method here, since HTML forms dont have it --}}
        @method('PUT')
        <div class="form-group">
            <label for="body">Post Body</label>
            {{-- Making a textarea that will update the body of the post. --}}
            <textarea name="body" id="body" class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}" placeholder="Enter Text">{{ old('body') ? : $post->body }}</textarea>
            {{-- If the errors array has a title error, we create a new span that echoes the first object that starts with 'title' --}}
            @if($errors->has('body'))
                <span class="invalid-feedback">
                    {{ $errors->first('body') }}
                </span>
            @endif
        </div>
        {{-- We will essentially copy the first div here for all of our validation form inputs. It's the sam econcept except with minor differences which I will note --}}
        
        {{-- This is a button that will let us submit the form, which will then inact the form action --}}
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection