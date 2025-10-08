<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Fasilitas;
use Illuminate\Http\Request;

class FacilitiesController extends Controller
{
    /**
     * Tampilkan semua fasilitas (halaman utama fasilitas).
     */
    public function index(Request $request)
    {
        // Query fasilitas
        $query = Fasilitas::query();

        // Jika ada pencarian nama fasilitas
        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
        }

        // Ambil semua data fasilitas
        $fasilitas = $query->get();

        // Tampilkan ke view home/fasilitas/index.blade.php
        return view('home.fasilitas.index', compact('fasilitas'));
    }

    /**
     * Tampilkan detail satu fasilitas.
     */
    public function show($id)
    {
        $fasilitas = Fasilitas::findOrFail($id);
        return view('home.fasilitas.show', compact('fasilitas'));
    }
}