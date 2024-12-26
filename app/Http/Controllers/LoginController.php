<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function login() {
        return view('login');
    }


    public function postlogin(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only(['email', 'password']))) {
            $user = Auth::user();
            $role = $user->role;

            switch ($role) {
                case 'admin':
                    return redirect()->route('homeadmin')->with('notifikasi', 'Selamat datang: ' . $user->nama);
                case 'pengguna':
                    return redirect()->route('homepengguna')->with('notifikasi', 'Selamat datang: ' . $user->nama);
                case 'owner':
                    return redirect()->route('owner')->with('notifikasi', 'Selamat datang: ' . $user->nama);
                case 'mekanik':
                    return redirect()->route('mekanik')->with('notifikasi', 'Selamat datang: ' . $user->nama);
                case 'kasir':
                    return redirect()->route('kasir')->with('notifikasi', 'Selamat datang: ' . $user->nama);
                default:
                    return redirect()->route('login')->with('status', 'Peran tidak dikenali');
            }
        }

        return redirect()->route('login')->with('status', 'Email atau password salah');
    }

    public function logout() {
        auth()->logout();
        return redirect()->route('login');
    }
    

}
