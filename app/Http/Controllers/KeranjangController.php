<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class KeranjangController extends Controller
{

    
    public function index()
    {
       
        $client = new Client();
        $authToken = Session::get('access_token');
    
        try {
            $response = $client->get('http://localhost:8000/api/pesananDetail', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $authToken,
                    'Accept' => 'application/json',
                ],
        ]);
    
            $data = json_decode($response->getBody()->getContents(), true);
    
                // Kirim data ke tampilan
            return view('menu.keranjang', ['cartItems' => $data['cart_items']]);
    
        } catch (\Exception $e) {
                // Kirim error ke tampilan
                return view('menu.keranjang')->with('error', 'Gagal mengambil data keranjang: ' . $e->getMessage());
        }
        }



        // return view('menu.keranjang'); // Pastikan ada tampilan keranjang.blade.php
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    // public function index()
    // {
    //     try {
    //         $client = new Client();
    //         $response = $client->post('http://localhost:8000/api/keranjang', [
    //             'headers' => [
    //             'Authorization' => 'Bearer ' . Session::get('access_token'),
                
    //         ],
    //     ]);
    //         $items = json_decode($response->getBody(), true)['data'] ?? [];

    //         return view('menu.keranjang', compact('items'));
    //     } catch (\Exception $e) {
    //         // Handle exceptions here
    //         return back()->withError($e->getMessage());
    //     }
    // }

    // public function addToCart(Request $request)
    // {
    //     $request->validate([
    //         'barang_id' => 'required|exists:barang,id',
    //         'quantity' => 'required|integer|min:1',
    //         'ukuran' => 'required|string|max:10',
    //     ]);

    //     $accessToken = Session::get('access_token');

    //     if (!$accessToken) {
    //         return redirect()->route('login')->withErrors(['message' => 'Please log in to add items to the cart.']);
    //     }

    //     try {
    //         $client = new Client();
    //         $response = $client->post('http://localhost:8000/api/Keranjang', [
    //             'headers' => [
    //                 'Authorization' => 'Bearer ' . $accessToken,
    //             ],
    //             'form_params' => [
    //                 'barang_id' => $request->barang_id,
    //                 'quantity' => $request->quantity,
    //                 'ukuran' => $request->ukuran,
    //             ],
    //         ]);

    //         $data = json_decode($response->getBody(), true);

    //         return back()->with('message', $data['message']);
    //     } catch (\Exception $e) {
    //         return back()->withErrors(['message' => 'Failed to add item to cart.']);
    //     }
    // }












}


    
