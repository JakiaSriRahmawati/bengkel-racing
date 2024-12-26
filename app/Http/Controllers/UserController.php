<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Rating;
use App\Models\User;
use App\Models\Order;
use App\Models\Booking;
use App\Models\Transaksi;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UserController extends Controller
{
    public function home() {
        $artikel = Artikel::all();
        $rating = Rating::all();
        return view('home', compact('artikel','rating'));
    }
    public function about()
    {
        return view('template.about');
    }

    public function homepengguna() {
        $artikel = Artikel::all();
        $rating = Rating::all();
        return view('pengguna.homepengguna', compact('artikel','rating'));
    }


    public function redirectToLogin() {
        return redirect()->route('login')->with('from_booking', true);
    }

    public function processPayment(Request $request, $orderId) {
        $order = Order::findOrFail($orderId);

        if ($order->status != 'unpaid') {
            return redirect()->route('profil')->with('error', 'Pesanan sudah dibayar.');
        }

        $order->status = 'paid';
        $order->save();

        return redirect()->route('profil')->with('status', 'Pembayaran berhasil!');
    }

    public function updateStatus(Request $request, $bookingId)
{
    $request->validate([
        'status_servis' => 'required|in:pending,received,in_progress,completed,rejected',
    ]);

    $booking = Booking::findOrFail($bookingId);
    $booking->status_servis = $request->status_servis;
    $booking->save();

    return back()->with('status', 'Status servis berhasil diperbarui!');
}

    public function booking() {
        return view('booking');
    }

    public function owner() {
        $users = User::all();
        $owners = User::where('role', 'owner')->get();
        $cashiers = User::where('role', 'kasir')->get();
        $mechanics = User::where('role', 'mekanik')->get();
        $bookings = Booking::all();
        $transactions = Transaksi::all();

        $ownerData = $this->getOwnerServiceData();

        return view('owner.owner', compact('users', 'owners', 'cashiers', 'mechanics', 'bookings', 'transactions', 'ownerData'));
    }

    private function getOwnerServiceData() {
        $currentYear = Carbon::now()->year;

        $ownerData = User::where('role', 'owner')->get()->map(function ($owner) use ($currentYear) {
            $monthlyData = [];

            for ($month = 1; $month <= 12; $month++) {
                $startOfMonth = Carbon::createFromDate($currentYear, $month, 1)->startOfMonth();
                $endOfMonth = Carbon::createFromDate($currentYear, $month, 1)->endOfMonth();

                $monthlyServiceCount = Booking::where('user_id', $owner->id)
                    ->whereBetween('tanggal_booking', [$startOfMonth, $endOfMonth])
                    ->count();

                $monthlyIncome = Transaksi::where('user_id', $owner->id)
                    ->whereBetween('tanggal_transaksi', [$startOfMonth, $endOfMonth])
                    ->sum('total_harga');

                $monthlyData[] = [
                    'month' => $startOfMonth->format('F'),
                    'service_count' => $monthlyServiceCount,
                    'income' => $monthlyIncome,
                ];
            }

            return [
                'owner' => $owner->nama,
                'monthly_data' => $monthlyData,
            ];
        });

        return $ownerData;
    }

   
    

    
}
