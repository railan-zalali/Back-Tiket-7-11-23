<?php

namespace App\Http\Controllers;

use App\Models\Bookings;
use App\Models\Pay;
use App\Models\Payment;
use App\Models\Tikets;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Admin/Pay/Index', [
            'head' => 'hai'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $barcodeData = $request->input('barcodeData');
        $bookingId = $barcodeData[0];

        $booking = Bookings::find($bookingId);

        if ($booking) {
            // Menentukan nilai 'tanggal' secara manual saat membuat entitas Payment
            $payment = new Payment([
                'bookings_id' => $bookingId,
                'tanggal' => now(),
                'status' => 'berhasil', // Atau dapat diganti dengan nilai tanggal yang diinginkan
                'code' => implode(',', $barcodeData)
            ]);

            $payment->save();

            return response()->json(['status' => 'success', 'message' => 'Barcode data saved successfully']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Booking not found']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Pay $pay)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pay $pay)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pay $pay)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pay $pay)
    {
        //
    }
    public function saveBarcode(Request $request)
    {
    }
}
