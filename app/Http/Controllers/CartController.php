<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    
    public function addToCart(Request $request)
    {
        // Validasi data dari form
        $validatedData = $request->validate([
            'barang_id' => 'required|exists:barang,id',
            'quantity' => 'required|integer|min:1',
            'ukuran' => 'required|string|max:10',
        ]);

        // Ambil token autentikasi jika diperlukan
        $token = Auth::user()->api_token; // Misalnya, jika Anda menyimpan token di tabel users

        try {
            // Kirim request ke API menggunakan Guzzle
            $response = Http::withToken($token)
                ->post(API_ENDPOINT . 'api/Keranjang', [
                    'barang_id' => $validatedData['barang_id'],
                    'quantity' => $validatedData['quantity'],
                    'ukuran' => $validatedData['ukuran'],
                ]);

            if ($response->successful()) {
                // Jika sukses, redirect dengan pesan sukses
                return redirect()->back()->with('message', 'Barang berhasil ditambahkan ke keranjang');
            } else {
                // Jika gagal, redirect dengan pesan error
                return redirect()->back()->withErrors(['error' => 'Gagal menambahkan barang ke keranjang']);
            }
        } catch (\Exception $e) {
            // Tangani error
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}
