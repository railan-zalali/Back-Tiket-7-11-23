<?php

namespace App\Http\Controllers;

use App\Http\Requests\TempatStoreRequest;
use App\Models\Tempat;
use Illuminate\Http\Request;

class TempatController extends Controller
{
    public function index()
    {
        $tempats = Tempat::all();

        return response()->json([
            'results' => $tempats
        ], 200);
    }

    public function show($id)
    {
        $tempat = Tempat::find($id);
        if (!$tempat) {
            return response()->json([
                'message' => 'Tempat Tidak Ditemukan'
            ], 404);
        }

        return response()->json([
            'tempat' => $tempat
        ], 200);
    }

    public function store(TempatStoreRequest $request)
    {
        try {
            $tempat = new Tempat;
            $tempat->namaTempat = $request->input('namaTempat');
            $tempat->alamat = $request->input('alamat');
            $tempat->kota = $request->input('kota');
            $tempat->kapasitas = $request->input('kapasitas');
            $tempat->deskripsi = $request->input('deskripsi');
            $tempat->tanggal = $request->input('tanggal');
            $tempat->harga = $request->input('harga');

            // Upload dan simpan gambar tempat jika diperlukan
            if ($request->hasFile('fotoTempat')) {
                $tempat->fotoTempat = $request->file('fotoTempat')->store('public/tempat');
            }

            $tempat->kontak = $request->input('kontak');
            $tempat->save();

            return response()->json([
                'message' => 'Tempat berhasil ditambahkan'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Ada Sesuatu Yang Salah!'
            ], 500);
        }
    }

    public function update(TempatStoreRequest $request, $id)
    {
        try {
            $tempat = Tempat::find($id);
            if (!$tempat) {
                return response()->json([
                    'message' => 'Tempat tidak ditemukan'
                ], 404);
            }

            $tempat->namaTempat = $request->input('namaTempat');
            $tempat->alamat = $request->input('alamat');
            $tempat->kota = $request->input('kota');
            $tempat->kapasitas = $request->input('kapasitas');
            $tempat->deskripsi = $request->input('deskripsi');
            $tempat->harga = $request->input('harga');
            // Upload dan simpan gambar tempat jika diperlukan
            if ($request->hasFile('fotoTempat')) {
                $tempat->fotoTempat = $request->file('fotoTempat')->store('public/tempat');
            }

            $tempat->kontak = $request->input('kontak');
            $tempat->save();

            return response()->json([
                'message' => 'Data tempat berhasil diperbarui'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Ada Sesuatu Yang Salah!'
            ], 500);
        }
    }

    public function destroy($id)
    {
        $tempat = Tempat::find($id);
        if (!$tempat) {
            return response()->json([
                'message' => 'Tempat tidak ditemukan'
            ], 404);
        }

        $tempat->delete();

        return response()->json([
            'message' => 'Data tempat berhasil dihapus'
        ], 200);
    }
    public function searchTiket(Request $request)
    {
        $this->validate($request, [
            'namaTempat' => 'required',
            'jumlahTiket' => 'required|integer|min:1', // Tambahkan validasi jumlah tiket
            'tanggal' => 'date',
        ]);

        $query = Tempat::where('namaTempat', $request->input('namaTempat'))
            ->where('tanggal', $request->input('tanggal'))
            ->where('kapasitas', '>=', $request->input('jumlahTiket')); // Menambahkan filter jumlah tiket

        // Tambahan logika pencarian sesuai kebutuhan Anda

        $result = $query->get();

        return response()->json(['data' => $result]);
    }
}
