<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Client;

class PembayaranController extends Controller
{
    
    
    public function index()
    {
        // Menampilkan halaman pembayaran
        return view('menu.checkout');
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    // public function index()
    // {
    //     $client = new Client();
    //     $token = Session::get('access_token'); // Ambil token dari sesi

    //     try {
    //         // Ambil informasi pesanan dari API jika diperlukan
    //         $response = $client->get('http://localhost:8000/api/user/pesanan', [
    //             'headers' => [
    //                 'Authorization' => 'Bearer ' . $token,
    //                 'Accept' => 'application/json',
    //             ],
    //         ]);

    //         // Decode respons API
    //         $data = json_decode($response->getBody()->getContents(), true);

    //         // Kirim data ke view
    //         return view('menu.checkout', [
    //             'pesanan' => $data['pesanan'] ?? null, // Sesuaikan dengan struktur respons API
    //         ]);
    //     } catch (\Exception $e) {
    //         return redirect()->route('keranjang')->with('error', 'Gagal mengambil data pembayaran: ' . $e->getMessage());
    //     }
    // }
}
}