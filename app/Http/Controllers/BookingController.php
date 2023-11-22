<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Models\Bookings;
use App\Models\Tempat;
use App\Models\Tikets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

use function Termwind\render;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //
    }

    public function count()
    {
        $id = auth()->user()->id;

        $jumlahData = Bookings::where('user_id', $id)->count();
        return response()->json($jumlahData);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Admin/Tempat/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($id)
    {
        // $booking = Bookings::find($id);
        // dd($booking->status);

        // Perbarui status booking menjadi 'success'
        // $booking->update(['status' => 'success']);

        // Cetak status setelah pembaruan
        // dd($booking->status);
        // $booking->update(['status' => 'success']);

        // Tikets::create([
        // 'bookings_id' => $booking->id,
        // Tambahkan bidang-bidang lain sesuai kebutuhan
        // ]);

        // return response()->json(['message' => 'Checkout berhasil']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $id = auth()->user()->id;

        $data = Bookings::with(['user', 'tempat'])
            ->where('user_id', $id)
            ->get();

        return Inertia::render('Cart', [
            "data" => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bookings $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookingRequest $request, Bookings $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            // Cari booking dengan ID yang dimaksud
            $booking = Bookings::find($id);

            // Pastikan booking ditemukan
            if (!$booking) {
                return response()->json(['message' => 'Booking not found'], 404);
            }

            // Hapus booking
            $booking->delete();

            // Hitung ulang jumlah booking untuk pengguna yang diotentikasi
            $id = auth()->user()->id;
            $data = Bookings::where('user_id', $id)->count();

            // Redirect dengan pesan dan jumlah booking terkini
            return redirect()->route('confirm.page')->with([
                'message' => 'Booking berhasil dihapus',
                'countBookings' => $data
            ]);
        } catch (\Exception $e) {
            // Tangani kesalahan
            return response()->json(['message' => 'Gagal melakukan hapus', 'error' => $e->getMessage()], 500);
        }
    }


    public function checkout(Request $request)
    {
        try {
            // Validasi request sesuai kebutuhan Anda
            $request->validate([
                // Sesuaikan aturan validasi dengan struktur data yang dikirim dari frontend
                'items' => 'required|array',
                'subtotal' => 'required|numeric',
                'jumlahData' => 'required|integer',
            ]);


            $user_id = auth()->user()->id;

            $data = Bookings::where('user_id', $user_id)->count();
            // Ambil data dari request
            $items = $request->input('items');
            $subtotal = $request->input('subtotal');
            $jumlahData = $request->input('jumlahData');
            $tanggal = date('Y-m-d', strtotime($items[0]['tanggal']));
            // Dapatkan id_tempat berdasarkan nama_tempat
            $id_tempat = Tempat::where('nama_tempat', $items[0]['nama_tempat'])->value('id');
            // dd($id_tempat);
            // Simpan data ke dalam tabel bookings
            $booking = new Bookings();
            $booking->user_id = $user_id;
            $booking->tempat_id = $id_tempat;
            $booking->tanggal = $tanggal;
            $booking->tipe_tiket = $items[0]['tipe_tiket'];
            $booking->harga = $subtotal;
            $booking->jumlah_tiket = $jumlahData;
            // dd($booking);


            $booking->save();


            return response()->json([
                'message' => 'Data berhasil disimpan',
                'countBookings' => $data
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal melakukan checkout', 'error' => $e->getMessage()], 500);
        }
    }
    public function confirmPage()
    {
        $id = auth()->user()->id;

        $jumlahData = Bookings::where('user_id', $id)->count();
        $bookings = Bookings::with(['user', 'tempat'])
            ->where('user_id', $id)
            ->get();
        // dd($bookings);
        return Inertia::render('Tiket/Confirm', [
            'head' => 'Confirm',
            'data' => $bookings,
            'countBookings' => $jumlahData
        ]);
    }
    public function confirmCheckout($id)
    {
        try {
            $booking = Bookings::findOrFail($id);
            $booking->update(['status' => 'success']);
            Tikets::create([
                'bookings_id' => $booking->id,
                // Tambahkan bidang-bidang lain sesuai kebutuhan
            ]);

            return redirect()->back()->with('success', 'Status booking berhasil diubah.');
        } catch (\Exception $e) {
            return response()->json(['error' => 'Konfirmasi gagal.'], 500);
        }
    }
}
