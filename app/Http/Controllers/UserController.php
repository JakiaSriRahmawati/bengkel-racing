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
use Illuminate\Support\Facades\DB;

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


    public function showForm($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);
        return view('rating.form', compact('booking'));
    }

    public function submit(Request $request, $bookingId)
    {
        // Validasi input
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string',
        ]);

        $booking = Booking::findOrFail($bookingId);

        $rating = new Rating();
        $rating->booking_id = $booking->id;
        $rating->user_id = auth()->id();
        $rating->rating = $request->rating;
        $rating->review = $request->review;
        $rating->save();

        return redirect()->route('profile'); 
    }
    public function show($orderId)
{
    $booking = Booking::findOrFail($orderId);
    $details = $booking->details; 

    return view('pengguna.profil', compact('booking', 'details'));
}

public function storeRating(Request $request, $bookingId)
{
    $user = auth()->user(); 

    $existingRating = Rating::where('user_id', $user->id)
        ->where('booking_id', $bookingId)
        ->first();

    if ($existingRating) {
        $existingRating->update([
            'rating' => $request->input('rating'),
            'review' => $request->input('review'),
        ]);

        return redirect()->route('profile')->with('success', 'Your rating and review have been updated!');
    }

    Rating::create([
        'user_id' => $user->id,
        'booking_id' => $bookingId,
        'rating' => $request->input('rating'),
        'review' => $request->input('review'),
    ]);

    return redirect()->route('profile')->with('success', 'Thank you for your rating and review!');
}

public function showRatingForm($bookingId)
{
    $user = auth()->user(); 
    
    $booking = Booking::find($bookingId);

    if (!$booking) {
        return redirect()->route('profile')->with('error', 'Booking not found.');
    }

    $userRating = Rating::where('user_id', $user->id)
                        ->where('booking_id', $bookingId)
                        ->first();

    return view('rating.form', compact('userRating', 'booking'));
}
public function index() {
    $ratings = DB::table('ratings')->get();  // Ambil semua rating dari DB
    return view('home', ['rating' => $ratings]);
}

  
}
