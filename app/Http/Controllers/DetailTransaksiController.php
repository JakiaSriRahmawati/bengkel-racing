<?php

namespace App\Http\Controllers;

use App\Models\booking;
use Illuminate\Support\Str;

use App\Models\detail_transaksi;
use Illuminate\Http\Request;

class DetailTransaksiController extends Controller
{
    public function store(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'harga_barang' => 'required|integer',
            'biaya_jasa' => 'required|integer',
        ]);

        // Assuming $booking is retrieved based on the $id
        // Replace this with the correct logic to get the booking
        $booking = booking::find($id); // Make sure to import the Booking model
        if (!$booking) {
            return redirect()->back()->with('error', 'Booking not found.');
        }

        // Create a new detail_transaksi record
        detail_transaksi::create([
            'booking_id' => $booking->id,
            'invoice' => Str::uuid()->toString(), // Generate a UUID and convert it to a string
            'nama_barang' => $request->input('nama_barang'), // Use the input values from the request
            'harga_barang' => $request->input('harga_barang'), // Use integers for numerical fields
            'biaya_jasa' => $request->input('biaya_jasa'), // Use integers for numerical fields
        ]);

        return redirect()->back()->with('success', 'Detail transaksi berhasil ditambahkan.');
    }

    public function showInvoice()
    {
        $details = detail_transaksi::with('booking.user')->get();
        return view('invoice', compact('details'));
    }
}
