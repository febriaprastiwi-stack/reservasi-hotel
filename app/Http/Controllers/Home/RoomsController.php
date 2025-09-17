<?php

namespace App\Http\Controllers\Home;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RoomsController extends Controller
{
    public function index()
    {
        $rooms = \App\Models\Room::all();

        // kirim data ke view
        return view('home.rooms.index', compact('rooms'));
    }
}
