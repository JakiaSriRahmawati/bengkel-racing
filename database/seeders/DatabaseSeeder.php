<?php

namespace Database\Seeders;

use App\Models\artikel;
use App\Models\barang;
use App\Models\booking;
use App\Models\BuktiPembayaran;
use App\Models\detail_transaksi;
use App\Models\IsiArtikel;
use App\Models\IsiRating;
use App\Models\mekanik;
use App\Models\rating;
use App\Models\transaksi;
use App\Models\User;
use Illuminate\Support\Str;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nama'=>'Zakia',
            'email'=>'zakia@gmail.com',
            'password'=>bcrypt('123'),
            'kontak'=>'089764327',
            'role'=>'admin',
        ]);

        User::create([
            'nama'=>'sri',
            'email'=>'sri@gmail.com',
            'password'=>bcrypt('321'),
            'kontak'=>'0897643215',
            'role'=>'pengguna',
        ]);

        User::create([
            'nama'=>'wati',
            'email'=>'wati@gmail.com',
            'password'=>bcrypt('345'),
            'kontak'=>'0897643213',
            'role'=>'owner',
        ]);

        User::create([
            'nama'=>'lala',
            'email'=>'lala@gmail.com',
            'password'=>bcrypt('456'),
            'kontak'=>'0897643212',
            'role'=>'kasir',
        ]);

        User::create([
            'nama'=>'neng',
            'email'=>'neng@gmail.com',
            'password'=>bcrypt('567'),
            'kontak'=>'0897643211',
            'role'=>'mekanik',
        ]);

        Booking::create([
            'user_id' => 2,
            'merek_motor' => 'Honda',
            'seri_motor' => 'Vario',
            'mesin_motor' => '150cc',
            'no_plat' => 'F 4B4D UBD',
            'jenis_servis' => 'Ganti Oli Mesin dan Oli Gardan', // Perbaiki nama kolom
            'tanggal_booking' => '2024-07-03', // Sesuaikan dengan nama kolom di migration
            'deskripsi' => 'Mau ganti oli dengan oli yang berkualitas',
        ]);
        barang::create([
            'booking_id' => 1,
            'nama_barang' => 'Kanvas Rem',
            'harga_barang' => '70000',
            'stok' => '100',
        ]);
       artikel::create([
        'user_id'=>'1',
        'gambar'=>'Img/r.jpg',
        'judul'=>'cara merawat motor',
        'berita'=>'cara merawat motor yaitu dengan sering melakukan servis rutinan setiap 1 bulan sekali',
       ]);
       artikel::create([
        'user_id'=>'1',
        'gambar'=>'Img/r.jpg',
        'judul'=>'cara merawat motor',
        'berita'=>'cara merawat motor yaitu dengan sering melakukan servis rutinan setiap 1 bulan sekali',
       ]);
       artikel::create([
        'user_id'=>'1',
        'gambar'=>'Img/r.jpg',
        'judul'=>'cara merawat motor',
        'berita'=>'cara merawat motor yaitu dengan sering melakukan servis rutinan setiap 1 bulan sekali',
       ]);
       artikel::create([
        'user_id'=>'1',
        'gambar'=>'Img/r.jpg',
        'judul'=>'cara merawat motor',
        'berita'=>'cara merawat motor yaitu dengan sering melakukan servis rutinan setiap 1 bulan sekali',
       ]);

       rating::create([
        'user_id'=>'1',
        'rating'=>'⭐⭐⭐⭐',
        'deskripsi'=>'rapih sekali',
       ]);
       rating::create([
        'user_id'=>'2',
        'rating'=>'⭐⭐⭐',
        'deskripsi'=>'bagus',
       ]);
       rating::create([
        'user_id'=>'3',
        'rating'=>'⭐⭐⭐⭐',
        'deskripsi'=>'baguss sekali',
       ]);
       rating::create([
        'user_id'=>'4',
        'rating'=>'⭐⭐',
        'deskripsi'=>'layanan nya kurang ramah',
       ]);
       
       BuktiPembayaran::create([
        'user_id'=>2,
        'booking_id'=>1,
        'gambar'=> 'image/20241226085941.png'
    ]);


    }
}
