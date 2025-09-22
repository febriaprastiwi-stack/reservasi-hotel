<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Room;

class KamarController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        return view('home.rooms.index', compact('rooms'));
    }

    public function show($id)
{
    $room = Room::findOrFail($id);
    return view('home.rooms.show', compact('room'));
}

}
