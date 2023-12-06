@extends('layouts.myapp')
{{-- I will show the details of the item in this page. --}}
@section('content')
    <h3 class="text-center">{{$post->title}}</h3>
    {{-- I made a table that displays every detail in a single cell. We don't need a for loop, as we're only showing one item --}}
    <table class="table table-primary table-striped">
        <tr>
            <td class="text-center">
                <h5>Body</h5>
                {{ $post->body }}
                
            </td>
        </tr>
        <tr>
            <td class="text-center">
                <h5>Created By</h5>
                {{ $post->users->name }}
            </td>
        </tr>
        <tr>
            <td class="text-center">
                <h5>For Thread</h5>
                {{ $post->threads->title }}
                
            </td>
        </tr>
        
    </table>
    <br>
    <a href="{{route('posts.edit',$post->id)}}" class="btn btn-primary float-left">Update</a>
    <a href="#" class="btn btn-danger float-right" data-bs-toggle="modal" data-bs-target="#delete-modal">Delete</a>
    <div class="clearfix"></div>
    {{-- Delete item modal. The popup window will ask you if you want to delete the item. --}}
    <div class="modal fade" id="delete-modal">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Post</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure?</p>
            </div>
            <div class="modal-footer">
                {{-- We find the form with querySelector, then submit the form with submit() --}}
                <button type="button" class="btn btn-danger" onclick="document.querySelector('#delete-form').submit()">Proceed</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
        </div>
    </div>
    {{-- The form routes to the songs.destroy route, which will run the destroy method. We're also passing the song id --}}
    <form method="POST" id="delete-form" action="{{route('posts.destroy',$post->id)}}">
        @csrf
        {{-- passing the value of DELETE since forms can only do post and get --}}
        @method('DELETE')
    </form>
@endsection