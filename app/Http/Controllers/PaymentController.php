<?php

namespace App\Http\Controllers;

use App\Models\booking;
use App\Models\BuktiPembayaran;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    

    public function uploadPaymentProof(Request $request, $id)
{
    $request->validate([
        'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
    ]);
    // dd($id);
    $booking = booking::findOrFail($id);
    if ($image = $request->file('gambar')) {

        $destinationPath = 'image/';

        $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();

        $image->move($destinationPath, $profileImage);

        $booking['gambar'] = "$profileImage";
        $booking->save();
    }

    return redirect()->back()->with('status', 'Bukti pembayaran berhasil diupload!');
    

    return redirect()->back()->with('error', 'Booking tidak ditemukan!');
}



public function verifyPayment($id)
{
    $booking = Booking::findOrFail($id);

    // Set is_paid ke true dan simpan ke database
    $booking->is_paid = true;
    $booking->save();

    return redirect()->back()->with('notifikasi', 'Pembayaran telah diverifikasi.');
}


    public function cancelOrder($id)
    {
        $order = booking::find($id);

        if ($order && $order->status_servis == 'pending') {
            $order->delete();
            return redirect()->back()->with('status', 'Pesanan berhasil dibatalkan!');
        }

        return redirect()->back()->with('error', 'Pesanan tidak ditemukan atau tidak bisa dibatalkan!');
    }
    
    

}
