@extends('layouts.myapp')
@section('content')
{{-- Displaying all threads created by user --}}
    @auth
    <h2 class="text-center">Announcements</h2>

    {{-- Announcement for loop. --}}
      <table class="table table-bordered mt-3" id="normal-table" style="table-layout:auto">
        <thead class="table-primary">
          <tr>
            <th scope="col" style="width:60%" class="p-2">Announcement</th>
            <th scope="col" class="p-2">Created By</th>
          </tr>
        @forelse($announces as $announce)
        </thead>
          <tbody>
            <tr>
              {{-- Link to show page --}}
              <td class="p-3"><a href="{{route('user.announcements.show',$announce->id)}}" id="counter" class="link-underline link-underline-opacity-0 link-underline-opacity-100-hover text-black">{{$announce->title}}</a></td>
              {{-- User name --}}
              <td class="p-3 pb-1"><a href="#" class="link-underline link-underline-opacity-0 link-underline-opacity-100-hover text-black row">{{$announce->user->name}}</a>
              <small style="color:#6672db">{{$announce->created_at->diffForHumans()}}</small></td>
            </tr>
          </tbody>
        @empty
          <h4 class="text-center">No Announcements Yet</h4>
        @endforelse
      </table>

      {{-- Most viewed threads --}}

    {{-- Pagination links --}}
    <div class="d-flex justify-content-center">
        {{ $announces->links() }}
    </div>
    @endauth

@endsection