<?php

namespace App\Http\Controllers;

use App\Http\Requests\TempatStoreRequest;
use App\Models\Bookings;
use App\Models\Tempat;
use App\Models\TicketType;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use PHPUnit\Framework\Attributes\Ticket;

class TempatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function home()
    {
        $id = auth()->user()->id;
        $data = User::where('id', $id)->get();

        return Inertia::render('Home', [
            'props' => $data
        ]);
    }
    public function index()
    {

        $today = Carbon::now();
        // Inisialisasi array untuk menyimpan tanggal dan hari
        $dates = [];
        // Loop untuk mengambil semua tanggal dalam 7 hari ke depan
        for ($i = 0; $i < 7; $i++) {
            $currentDate = $today->clone()->addDays($i);
            $formattedDate = $currentDate->format('d-m-Y');
            $dayOfWeek = $currentDate->isoFormat('dddd'); // Menampilkan hari dalam bahasa Inggris

            $dates[] = [
                'date' => $formattedDate,
                'day' => $dayOfWeek,
            ];
        }
        $id = auth()->user()->id;
        $jumlahData = Bookings::where('user_id', $id)->count();
        $data = Tempat::all();
        return Inertia::render('Tiket/Index', [
            'props' => $data,
            'today' => $today,
            'dateAndDays' => $dates,
            'countBookings' => $jumlahData
        ]);
    }


    public function tampilkanTanggal()
    {
        // Tanggal hari ini
        $today = Carbon::now();

        // Tanggal 1 minggu ke depan
        $nextWeek = Carbon::now()->addWeek();

        return Inertia::render('Tiket', [
            'today' => $today,
            'nextWeek' => $nextWeek,
        ]);
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

    public function update(TempatStoreRequest $request, $id)
    {
        try {
            $tempat = Tempat::find($id);
            if (!$tempat) {
                return response()->json([
                    'message' => 'Tempat tidak ditemukan'
                ], 404);
            }

            $tempat->nama_tempat = $request->input('nama_tempat');
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
    public function searchTickets(Request $request)
    {
        $request->validate([
            'nama_tempat' => 'required|string',
            // Add other validation rules as needed
        ]);

        // Logika untuk mengambil data dan menginisialisasi tanggal dan hari
        $today = Carbon::now();
        Carbon::setLocale('id');

        $dates = [];

        for ($i = 0; $i < 7; $i++) {
            $currentDate = $today->clone()->addDays($i);
            $formattedDate = $currentDate->format('d-m-Y');
            $dayOfWeek = $currentDate->isoFormat('dddd');

            $dates[] = [
                'date' => $formattedDate,
                'day' => $dayOfWeek,
            ];
        }

        $id = auth()->user()->id;

        $jumlahData = Bookings::where('user_id', $id)->count();
        $result = Tempat::where('nama_tempat', $request->nama_tempat)
            ->get();

        // Merender tampilan dengan data
        return Inertia::render('Tiket/ResultSearch', [
            'head' => 'result',
            'result' => $result,
            'dateAndDays' => $dates,
            'countBookings' => $jumlahData
        ]);
    }

    // Assuming $searchResults is an array of results, you can pass it to the Inertia view
    // return Inertia::render('ResultSearch', [
    //     'searchResults' => $result,
    //     'dateAndDays' => $dates,
    // ]);
    public function search(Request $request)
    {
        $request->validate([
            'nama_tempat' => 'required|string',
            // Add other validation rules as needed
        ]);
        // dd($request);
        // Tanggal hari ini
        $today = Carbon::now();
        Carbon::setLocale('id');

        // Inisialisasi array untuk menyimpan tanggal dan hari
        $dates = [];

        // Loop untuk mengambil semua tanggal dalam 7 hari ke depan
        for ($i = 0; $i < 7; $i++) {
            $currentDate = $today->clone()->addDays($i);
            $formattedDate = $currentDate->format('d-m-Y');
            $dayOfWeek = $currentDate->isoFormat('dddd'); // Menampilkan hari dalam bahasa Inggris

            $dates[] = [
                'date' => $formattedDate,
                'day' => $dayOfWeek,
            ];
        }
        return Inertia::render('Tiket/ResultSearch', [
            'head' => 'result',
            'dateAndDays' => $dates,
        ]);
    }
}
