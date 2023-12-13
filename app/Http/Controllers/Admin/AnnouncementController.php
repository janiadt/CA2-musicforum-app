<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Announcement;
use Auth;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $announces = Announcement::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.announcements.index', [
            'announces' => $announces
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.announcements.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         // Validation rules for my announcement table
         $rules = [
             'title' => 'required|string|min:1|max:255',
             'body'  => 'required|string|min:3|max:10000'
         ];
 
         $request->validate($rules);
         $announce = new Announcement;
         $announce->title = $request->title;
         $announce->body = $request->body;
         $announce->user_id = Auth::id();
         $announce->save();
         return redirect()
            //  Routing to admin announcement index
             ->route('admin.announcements.index')
             ->with('status','Created a new Announcement!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $announce = Announcement::findOrFail($id);
        return view('admin.announcements.show', [
            'announce' => $announce
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $announce = Announcement::findOrFail($id);
        return view('admin.announcements.edit', [
            'announce' => $announce
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validation rules for my announcement table
        $rules = [
            'title' => 'required|string|min:1|max:255',
            'body'  => 'required|string|min:3|max:10000'
        ];

        $request->validate($rules);
        $announce = Announcement::findOrFail($id);
        $announce->title = $request->title;
        $announce->body = $request->body;
        $announce->user_id = $announce->user_id;
        $announce->save();
        return redirect()
           //  Routing to admin announcement index
            ->route('admin.announcements.show', $announce->id)
            ->with('status','Updated the Announcement!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $announce = Announcement::findOrFail($id);
        $announce->delete();
        return redirect()
            ->route('admin.announcements.index')
            ->with('status', 'Deleted the Announcement!');
    }
}
