<?php

namespace App\Http\Controllers;

use App\Models\KetersediaanKamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class KetersediaanKamarController extends Controller
{
    public function index()
    {
        $ketersediaan_kamar = KetersediaanKamar::all();
        return view('pages.dashboard.ketersediaan_kamar.index', compact('ketersediaan_kamar'));
    }

}
