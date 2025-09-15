<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    /**
     * Tampilkan daftar kamar.
     */
    public function index()
    {
        $rooms = Room::all();
        return view('pages.admin.rooms.index', compact('rooms'));
    }

    /**
     * Form tambah kamar.
     */
    public function create()
    {
        return view('pages.admin.rooms.create');
    }

    /**
     * Simpan kamar baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nomor_kamar' => 'required|unique:rooms',
            'jenis_kamar' => 'required',
            'fasilitas_kamar' => 'nullable|string',
            'jumlah_kasur' => 'required|integer|min:1',
            'gambar_kasur' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar_kasur')) {
            $data['gambar_kasur'] = $request->file('gambar_kasur')->store('rooms', 'public');
        }

        Room::create($data);

        return redirect()->route('rooms.index')->with('success', 'Kamar berhasil ditambahkan.');
    }

    /**
     * Detail kamar.
     */
    public function show(Room $room)
    {
        return view('pages.admin.rooms.show', compact('room'));
    }

    /**
     * Form edit kamar.
     */
    public function edit(Room $room)
    {
        return view('pages.admin.rooms.edit', compact('room'));
    }

    /**
     * Update data kamar.
     */
    public function update(Request $request, Room $room)
    {
        $request->validate([
            'nomor_kamar' => 'required|unique:rooms,nomor_kamar,' . $room->id,
            'jenis_kamar' => 'required',
            'fasilitas_kamar' => 'nullable|string',
            'jumlah_kasur' => 'required|integer|min:1',
            'gambar_kasur' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar_kasur')) {
            if ($room->gambar_kasur) {
                Storage::disk('public')->delete($room->gambar_kasur);
            }
            $data['gambar_kasur'] = $request->file('gambar_kasur')->store('rooms', 'public');
        }

        $room->update($data);

        return redirect()->route('rooms.index')->with('success', 'Data kamar berhasil diperbarui.');
    }

    /**
     * Hapus kamar.
     */
    public function destroy(Room $room)
    {
        if ($room->gambar_kasur) {
            Storage::disk('public')->delete($room->gambar_kasur);
        }

        $room->delete();

        return redirect()->route('rooms.index')->with('success', 'Kamar berhasil dihapus.');
    }
}
