<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function cancelOrder($id)
{
    $order = Order::find($id);
    
    if ($order && $order->status_servis == 'pending') {
        $order->status_servis = 'canceled'; // atau 'rejected', tergantung kebutuhan
        $order->save();
        
        return redirect()->back()->with('status', 'Pesanan berhasil dibatalkan.');
    }
    
    return redirect()->back()->with('error', 'Pesanan tidak dapat dibatalkan.');
}
}
