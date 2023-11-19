<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Bookings;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TicketsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        // Validasi formulir di sini jika diperlukan

        // Simpan data ke dalam database
        $id = auth()->user()->id; // Ambil ID pengguna yang terautentikasi
        $tempatId = $request->input('tempatId');
        $tanggal = $request->input('tanggal');
        $ticketType = $request->input('ticketType');
        $harga = $request->input('harga');

        if ($ticketType == 'VIP') {
            $harga += 10000;
        }
        // dd($harga);
        $bookingDate = Bookings::create([
            'user_id' => $id,
            'tempat_id' => $tempatId,
            'tanggal' => date('Y-m-d', strtotime($tanggal)),
            'tipe_tiket' => $ticketType,
            'harga' => $harga,
            'status' => 'pending', // Sesuaikan sesuai kebutuhan
        ]);

        return response()->json([
            'success' => true,
            'data' => $bookingDate
        ]);
        // Redirect atau kirim respons balik ke React
        // return Inertia::render('Tiket', [
        //     'pesan' => 'berhasil'
        // ]);
    }
}
