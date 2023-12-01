@extends('layouts.myapp')
{{-- Thread details. WIll change the look of this page in future commits. --}}
@section('content')
    <h3 class="text-center">{{$thread->title}}</h3>
    {{-- Displaying the data of the thread table --}}
    <table class="table table-primary table-striped">
        <tr>
            <td class="text-left">
                <img src="{{ $thread->image }} " alt="" style="max-width:200px">
            </td>
        </tr>
        <tr>
            <td class="text-left">
                {{ $thread->body }}
            </td>
        </tr>
        <tr>
            <td class="text-left">
                <h5>Music Category</h5>
                {{ $thread->music_category }}
            </td>
        </tr>
        <tr>
            <td class="text-left">
                <h5>Submitted By:</h5>
                {{ $thread->users->name }} 
            </td>
        </tr>
        
        
    </table>
    <br>
    {{-- Edit route passing an array of parameters. We need the current user's ID, so we know who's actually editing the page and if they're allowed to --}}
    {{-- As another step of security, we will lock the whole html expression behind an if statement that checks if the user's id is correct --}}
    @if ($thread->user_id === Illuminate\Support\Facades\Auth::user()->id)
    <a href="{{route('threads.edit', $thread->id) }}" class="btn btn-primary float-left">Edit</a>
    <a href="#" class="btn btn-danger float-right" data-bs-toggle="modal" data-bs-target="#delete-modal">Delete</a>
    <div class="clearfix"></div>
    {{-- Delete pop-up --}}
    <div class="modal fade" id="delete-modal">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Thread</h5>
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
    {{-- Routing to the thread destroy method. Passing thread id --}}
    <form method="POST" id="delete-form" action="{{route('threads.destroy',$thread->id)}}">
        @csrf
        {{-- passing the value of DELETE since forms can only do post and get --}}
        @method('DELETE')
    </form>
    @endif
    
@endsection