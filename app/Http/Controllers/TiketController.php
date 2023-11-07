<?php

namespace App\Http\Controllers;

use App\Models\Tempat;
use Illuminate\Http\Request;

class TiketController extends Controller
{
    public function search(Request $request)
    {
        $namaTempat = $request->input('namaTempat');
        $tanggal = $request->input('tanggal');

        // Lakukan pencarian berdasarkan namaTempat dan tanggal
        $results = Tempat::where('namaTempat', $namaTempat)
            ->where('tanggal', $tanggal)
            ->get();

        return response()->json([
            'results' => $results
        ], 200);
    }
}
