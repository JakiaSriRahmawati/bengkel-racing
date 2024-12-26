<?php

namespace App\Http\Controllers;

use App\Models\booking;
use App\Models\detail_transaksi;
use App\Models\Order;

use Illuminate\Http\Request;

class KasirController extends Controller
{
    public function kasir()
    {
        $bookings = Booking::with('user', 'buktiPembayaran')->get();
        $details = detail_transaksi::with('booking.user')->get();
    
        return view('kasir.kasir', compact('bookings', 'details'));
    }
    

    public function verifyPayment($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->is_paid = true;
        $booking->save();

        return redirect()->route('kasir')->with('status', 'Pembayaran diverifikasi');
    }

    public function showInvoice()
    {
        $details = detail_transaksi::with('booking.user')->get();

        return view('kasir.invoice', compact('details'));
    }


}
