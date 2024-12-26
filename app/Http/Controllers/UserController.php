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



    public function create($booking_id) {
        $booking = Booking::findOrFail($booking_id);

        // Pastikan booking dimiliki oleh user yang sedang login
        if ($booking->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses.');
        }

        // Cek jika sudah ada rating
        if ($booking->rating) {
            return redirect()->back()->with('error', 'Rating sudah diberikan.');
        }

        return view('ratings.create', compact('booking'));
    }

    public function store(Request $request) {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'rating'     => 'required|integer|min:1|max:5',
            'deskripsi'  => 'nullable|string|max:500',
        ]);

        $booking = Booking::findOrFail($request->booking_id);

        // Cek apakah user memiliki booking ini
        if ($booking->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses.');
        }

        // Simpan rating
        Rating::create([
            'user_id'    => auth()->id(),
            'booking_id' => $request->booking_id,
            'rating'     => $request->rating,
            'deskripsi'  => $request->deskripsi,
        ]);

        return redirect()->route('bookings.index')->with('success', 'Rating berhasil disimpan.');
    }
   
    

    
}
