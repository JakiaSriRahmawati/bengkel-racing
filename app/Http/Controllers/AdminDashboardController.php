<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Booking;
use App\Models\Transaksi;

class AdminDashboardController extends Controller
{
    public function homeadmin() {
        $users = User::where('role', 'pengguna')->get();
        $owners = User::where('role', 'owner')->get();
        $cashiers = User::where('role', 'kasir')->get();
        $mechanics = User::where('role', 'mekanik')->get();
        $bookings = Booking::all();
        $transactions = Transaksi::all();
        return view('admin.homeadmin', compact('users', 'owners', 'cashiers', 'mechanics', 'bookings', 'transactions'));
        
    }
}
