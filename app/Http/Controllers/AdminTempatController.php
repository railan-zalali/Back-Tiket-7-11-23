<?php

namespace App\Http\Controllers;

use App\Models\AdminTempat;
use App\Models\Tempat;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminTempatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tempats = Tempat::all();
        return Inertia::render('Admin/Tempat/Index', [
            'tempats' => $tempats
        ]);
    }

    public function create()
    {
        return inertia('Admin/Tempat/Create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_tempat' => 'required',
            'deskripsi' => 'required',
            'alamat' => 'required',
            'kapasitas' => 'required|integer',
            'harga' => 'required|numeric',
            'foto_tempat' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'kontak' => 'required',
        ]);

        // Upload gambar
        $foto_tempat = $request->file('foto_tempat');
        $fotoFileName = time() . '.' . $foto_tempat->extension();
        $foto_tempat->storeAs('public/foto_tempats', $fotoFileName);

        // Simpan data ke database
        Tempat::create([
            'nama_tempat' => $request->nama_tempat,
            'deskripsi' => $request->deskripsi,
            'alamat' => $request->alamat,
            'kapasitas' => $request->kapasitas,
            'harga' => $request->harga,
            'foto_tempat' => $fotoFileName,
            'kontak' => $request->kontak,
        ]);

        return redirect()->route('tempats.index');
    }

    public function edit(Tempat $tempat)
    {
        return inertia('Admin/Tempat/Edit', [
            'tempat' => $tempat,
        ]);
    }

    public function update(Request $request, Tempat $tempat)
    {
        // Validasi input di sini jika diperlukan
        $tempat->update($request->all());

        return redirect()->route('tempats.index');
    }

    public function destroy(Tempat $id)
    {
        // dd($id);

        // $id->delete();
        $id->delete();
        // dd($delete);
        return redirect()->route('tempats.index');
    }
}
