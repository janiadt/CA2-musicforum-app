<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Announcement;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    // In the user announcement controller, we only need the index and show.
    public function index()
    {
        $announces = Announcement::orderBy('created_at', 'desc')->paginate(10);
        return view('user.announcements.index', [
            'announces' => $announces
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $announce = Announcement::findOrFail($id);
        return view('user.announcements.show', [
            'announce' => $announce
        ]);

    }

}
