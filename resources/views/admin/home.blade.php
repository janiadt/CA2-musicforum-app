<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">


                        <p>You are an admin user</p>

                    </div>

                    <div>
                      <a href="{{route('admin.announcements.create')}}" class="btn btn-primary px-2">Make an announcement!</a> 
                    </div>
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400" id="normal-table" style="table-layout:auto">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                              <tr>
                                <h4 class="fw-bold">All Threads</h4>
                                <th scope="col" style="width:60%" class="p-2">Thread Title</th>
                                <th scope="col" class="p-2">Created By</th>
                                <th scope="col" class="p-2">Post Count</th>
                                <th scope="col" class="p-2">Views</th>
                              </tr>
                            @forelse($threads as $thread)
                            </thead>
                              <tbody class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <tr>
                                  {{-- Link to show page --}}
                                  <td class="p-3"><a href="{{route('threads.show',$thread->id)}}" id="counter" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">{{$thread->title}}</a></td>
                                  {{-- Link to user page --}}
                                  <td class="p-3 pb-1"><p class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$thread->users->name}}</p>
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
                        <div class="row justify-content-center">
                            {{ $threads->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>