<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Redirect;
use GuzzleHttp\Client;

use Illuminate\Support\Facades\Auth;

class PesanController extends Controller
{
    public function addToCart(Request $request)
    {
        $client = new Client();
    
        // Data yang akan dikirim ke API
        $postData = [
            'barang_id' => $request->input('barang_id'),
            'quantity' => $request->input('quantity'),
            'ukuran' => $request->input('ukuran'),
        ];
    
        // Ambil token dari sesi
        $authToken = Session::get('access_token');
    
        try {
            $response = $client->post('http://localhost:8000/api/Keranjang', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $authToken, // Token autentikasi dari sesi
                    'Accept' => 'application/json',
                ],
                'json' => $postData, // Mengirim data dalam format JSON
            ]);
    
            // Decode body respons
            $responseBody = json_decode($response->getBody()->getContents(), true);
    
            // Periksa apakah respons body berhasil di-decode dan memiliki kunci 'message'
            if (is_array($responseBody) && isset($responseBody['message'])) {
                return redirect()->to('/Keranjang')->with('success', $responseBody['message']);
            } else {
                // Tangani kasus di mana respons tidak seperti yang diharapkan
                return redirect()->back()->with('error', 'Unexpected response format.');
            }
    
        } catch (RequestException $e) {
            // Tangani kesalahan yang mungkin terjadi selama permintaan
            return redirect()->back()->with('error', 'Gagal menambahkan barang ke keranjang: ' . $e->getMessage());
        }
    }

    public function storePesanan()
    {
        $client = new Client();
        $token = Session::get('access_token'); // Ambil token dari sesi

        try {
            $response = $client->post('http://localhost:8000/api/store-pesanan', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Accept' => 'application/json',
                ],
                // Tidak perlu mengirimkan body jika API tidak membutuhkannya
            ]);

            // Decode respons API
            $responseBody = json_decode($response->getBody()->getContents(), true);

          // Redirect ke halaman pembayaran dengan pesan sukses
          return Redirect::to('/pembayaran')->with('success', $responseBody['message']);
        } catch (\Exception $e) {
            // Redirect dengan pesan error ke halaman keranjang
            return Redirect::to('/pembayaran')->with('error', 'Gagal menyimpan pesanan: ' . $e->getMessage());
        }
    }

    












   
    // public function addToCart(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'barang_id' => 'required|integer',
    //         'quantity' => 'required|integer',
    //         'ukuran' => 'required|string',
    //         'total' => 'required|integer',
    //     ]);

    //     $validatedData['user_id'] = Auth::id();

    //     $client = new Client();
    //     $response = $client->post('http://localhost:8000/api/pesanan-details', [
    //         'form_params' => $validatedData
    //     ]);

    //     if ($response->getStatusCode() == 201) {
    //         return redirect('/PesananDetail')->with('message', 'Pesanan berhasil ditambahkan ke keranjang.');
    //     } else {
    //         return back()->withErrors('Terjadi kesalahan saat menambahkan pesanan.');
    //     }
    // }
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
    // public function store(Request $request)
    // {
    //     try {
    //         $client = new Client();
    //         $response = $client->post('http://localhost:8000/api/pesanan_detail', [
    //             'headers' => [
    //                 'Authorization' => 'Bearer ' . Session::get('access_token'),
    //                 'Accept' => 'application/json',
    //             ],
    //             'json' => [
    //                 'user_id' => auth()->id(), // Menggunakan ID user yang sedang login
    //                 'barang_id' => $request->barang_id,
    //                 'gambar' => $request->gambar,
    //                 'quantity' => $request->quantity,
    //                 'ukuran' => $request->ukuran,
    //                 'total' => $request->total,
    //             ],
    //         ]);

    //         if ($response->getStatusCode() == 201) {
    //             return redirect('/pesan')->with('success', 'Pesanan berhasil dikirim.');
    //         } else {
    //             return back()->withErrors(['message' => 'Gagal mengirim pesanan. Silakan coba lagi.']);
    //         }
    //     } catch (\Exception $e) {
    //         return back()->withErrors(['message' => 'Terjadi kesalahan. Silakan coba lagi nanti.']);
    //     }
    // }


    public function show($id)
    {
        $client = new Client();
        $response = $client->get('http://localhost:8000/api/barang/' . $id);

        if ($response->getStatusCode() == 200) {
            $data = json_decode($response->getBody(), true);

            // Pastikan data 'barang' ada dan memiliki key 'gambar'
            if (isset($data['barang']) && isset($data['barang']['gambar'])) {
                $barang = $data['barang'];
                return view('menu.pesan', compact('barang'));
            } else {
                abort(404, 'Barang tidak ditemukan');
            }
        } else {
            abort(404, 'Barang tidak ditemukan');
        }
    }

    // public function addToCart(Request $request)
    // {
    //     // Mendapatkan token dari sesi
    //     $token = session('api_token'); // Menggunakan 'api_token'
    
    //     try {
    //         $client = new Client();
    //         $response = $client->post('http://localhost:8000/api/keranjang', [ // Pastikan endpoint yang benar
    //             'headers' => [
    //                 'Authorization' => 'Bearer ' . $token,
    //                 'Accept' => 'application/json',
    //             ],
    //             'json' => [
    //                 'barang_id' => $request->input('barang_id'),
    //                 'quantity' => $request->input('quantity'),
    //                 'ukuran' => $request->input('ukuran'),
    //                 'total' => $request->input('total'),
    //             ]
    //         ]);
    
    //         if ($response->getStatusCode() == 201) {
    //             $responseBody = json_decode($response->getBody()->getContents(), true);
    //             return redirect()->back()->with('message', $responseBody['message']);
    //         } else {
    //             return back()->withErrors(['message' => 'Gagal menambahkan item ke keranjang. Silakan coba lagi.']);
    //         }
    //     } catch (\Exception $e) {
    //         return back()->withErrors(['message' => 'Terjadi kesalahan. Silakan coba lagi nanti.']);
    //     }
    // }

    

    // UPDATE TOTAL
    // public function update(Request $request, $id)
    // {
    //     $client = new Client();
    //     $response = $client->get('http://localhost:8000/api/barang/' . $id);

    //     if ($response->getStatusCode() == 200) {
    //         $barang = json_decode($response->getBody(), true)['barang'];
    //         $quantity = $request->input('quantity', 1);

    //         return view('menu.pesan', compact('barang', 'quantity'));
    //     } else {
    //         abort(404, 'Barang tidak ditemukan');
    //     }
    // }


    // public function index($id)
    // {
    //     // Ambil data barang dari $id
    //     $barang = Barang::findOrFail($id); // Misalnya model Barang Anda adalah Barang

    //     // Kemudian tampilkan view 'pesan' sambil mengirimkan data barang
    //     return view('pesan')->with('barang', $barang);
    // }
}