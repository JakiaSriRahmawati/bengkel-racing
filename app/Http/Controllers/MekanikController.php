<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\booking;
use App\Models\Detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Import DB facade
use Illuminate\Support\Str;



class MekanikController extends Controller
{
    public function mekanik() 
    {
        $bookings = booking::with('user')->get();
        $parts = barang::all();
        return view('mekanik.mekanik', compact('bookings', 'parts'));
    }

    public function store(Request $request, $booking_id)
    {
        $request->validate([
            'part_id' => 'required|exists:barangs,id',
            'harga_barang' => 'required|numeric',
            'jumlah_barang' => 'required|integer|min:1',
            'biaya_jasa' => 'required|numeric',
        ]);

        $part = Barang::findOrFail($request->part_id);

        // Check if the stock is sufficient
        if ($part->stok < $request->jumlah_barang) {
            return redirect()->back()->with('error', 'Stok barang tidak mencukupi!');
        }

        // Add the transaction detail
        $detail = new Detail();
        $detail->booking_id = $booking_id;
        $detail->invoice = Str::random(10); // Generate random invoice or apply your logic
        $detail->nama_barang = $part->nama_barang;
        $detail->harga_barang = $request->harga_barang;
        $detail->jumlah_barang = $request->jumlah_barang;
        $detail->biaya_jasa = $request->biaya_jasa;
        $detail->save();

        // Reduce the stock
        $part->stok -= $request->jumlah_barang;
        $part->save();

        return redirect()->back()->with('status', 'Detail pesanan berhasil ditambahkan!');
    }
 

    public function addPart(Request $request)
{
    $request->validate([
        'nama_barang' => 'required|string|max:255',
        'harga_barang' => 'required|numeric',
        'stok' => 'required|integer',
    ]);

    $part = new Barang();
    $part->nama_barang = $request->nama_barang;
    $part->harga_barang = $request->harga_barang;
    $part->stok = $request->stok;
    $part->save();

    return redirect()->route('mekanik')->with('status', 'Barang berhasil ditambahkan!');
}

public function tambah_barang() 
    {
        return view('mekanik.tambah_barang');
    }

}
