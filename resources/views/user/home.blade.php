<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">


                        <p>You are a user</p>

                    </div>
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 " id="normal-table" style="table-layout:auto">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                              <tr>
                                <th scope="col" style="width:60%" class="p-2">Thread Title</th>
                                <th scope="col" class="p-2">Created By</th>
                                <th scope="col" class="p-2">Post Count</th>
                                <th scope="col" class="p-2">Views</th>
                              </tr>
                            @forelse($threads as $thread)
                            </thead>
                              <tbody class="bg-white border-b">
                                <tr>
                                  {{-- Link to show page --}}
                                  <td class="p-3"><a href="{{route('threads.show',$thread->id)}}" id="counter" class="font-medium text-blue-600 hover:underline">{{$thread->title}}</a></td>
                                  {{-- Link to user page --}}
                                  <td class="p-3 pb-1"><p class="font-medium text-gray-900 whitespace-nowrap">{{$thread->users->name}}</p>
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
                </div>
            </div>
        </div>
    </div>

</x-app-layout>