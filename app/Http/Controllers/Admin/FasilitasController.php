<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Fasilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FasilitasController extends Controller
{
    public function index()
    {
        $fasilitas = Fasilitas::all();
        return view('pages.admin.fasilitas.index', compact('fasilitas'));
    }

    public function create()
    {
        return view('pages.admin.fasilitas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'      => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'image'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['nama','deskripsi']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('fasilitas', 'public');
        }

        Fasilitas::create($data);

        return redirect()->route('fasilitas.index')->with('success', 'Fasilitas berhasil ditambahkan.');
    }

    public function edit(Fasilitas $fasilita)
    {
        return view('pages.admin.fasilitas.edit', compact('fasilita'));
    }

    public function show(Fasilitas $fasilita)
    {
        return view('pages.admin.fasilitas.show', compact('fasilita'));
    }

    public function update(Request $request, Fasilitas $fasilita)
    {
        $request->validate([
            'nama'      => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'image'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['nama','deskripsi']);

        if ($request->hasFile('image')) {
            if ($fasilita->image) {
                Storage::disk('public')->delete($fasilita->image);
            }
            $data['image'] = $request->file('image')->store('fasilitas', 'public');
        }

        $fasilita->update($data);

        return redirect()->route('fasilitas.index')->with('success', 'Fasilitas berhasil diperbarui.');
    }

    public function destroy(Fasilitas $fasilita)
    {
        if ($fasilita->image) {
            Storage::disk('public')->delete($fasilita->image);
        }

        $fasilita->delete();
        return redirect()->route('fasilitas.index')->with('success', 'Fasilitas berhasil dihapus.');
}
}
