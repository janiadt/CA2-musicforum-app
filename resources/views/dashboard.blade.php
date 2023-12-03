<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>

    {{-- Displaying every thread that the current user posted --}}
    <div>
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
    </div>
</x-app-layout>
