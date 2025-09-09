<?php

namespace App\Http\Controllers;
use App\Models\Rooms;
use Illuminate\Http\Request;

class RoomsController extends Controller
{
    public function index()
    {
        $rooms = Rooms::all();
        return view('rooms.index', compact('rooms'));
    }
    public function show($id)
    {
        $room = Rooms::findOrFail($id);
        return view('rooms.show', compact('room'));
    }
    public function create()
    {
        return view('rooms.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'nomor_kamar' => 'required|unique:rooms,nomor_kamar|max:10',
            'tipe_kamar' => 'required|max:64',
            'harga' => 'required|numeric',
            'status' => 'required|in:available,booked',
        ]); 
        Rooms::create($request->all());
        return redirect()->route('rooms.index')->with('success', 'Room created successfully.');
    }
        public function edit($id)
        {
            $room = Rooms::findOrFail($id);
            return view('rooms.edit', compact('room'));
        }
        public function update(Request $request, $id)
        {
            $request->validate([
                'nomor_kamar' => 'required|unique:rooms,nomor_kamar,'.$id.'|max:10',
                'tipe_kamar' => 'required|max:64',
                'harga' => 'required|numeric',
                'status' => 'required|in:available,booked',
            ]);
            $room = Rooms::findOrFail($id);
            $room->update($request->all());
            return redirect()->route('rooms.index')->with('success', 'Room updated successfully.');
        }
        public function destroy($id)
        {
            $room = Rooms::findOrFail($id);
            $room->delete();
            return redirect()->route('rooms.index')->with('success', 'Room deleted successfully.');
        }
}
