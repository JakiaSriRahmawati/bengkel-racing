<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\BuktiPembayaran;
use App\Models\Detail;
use App\Models\detail_transaksi;
use App\Models\Order;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $orders = Booking::where('user_id', $user->id)->get();
        $details = detail_transaksi::with('booking.user')->whereHas('booking', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();
        
        return view('pengguna.profil', compact('user', 'orders', 'details'));
    }

    public function showInvoice()
    {
        $details = detail_transaksi::with('booking.user')->get();

        return view('pengguna.profil', compact('details'));
    }

}

