<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class BarangController extends Controller
{
    public function show($id)
    {
        $client = new Client();
        $response = $client->get('http://localhost:8000/api/barang/' . $id);

        if ($response->getStatusCode() == 200) {
            $barang = json_decode($response->getBody(), true)['barang'];
            return view('frontend.shop.detail', compact('barang'));
        } else {
            abort(404, 'Barang tidak ditemukan');
        }
    }

    public function searchProduct(Request $request)
{
    $client = new Client();

    // Retrieve the product name from the search input
    $namaBarang = $request->input('nama_barang');

    try {
        // Send a GET request to the API with the product name
        $response = $client->get('http://localhost:8000/api/barang/nama/' . $namaBarang);

        if ($response->getStatusCode() == 200) {
            // Decode the response and get the product details
            $barang = json_decode($response->getBody(), true)['barang'];
            return view('frontend.shop.detail', compact('barang'));
        } else {
            // If the product is not found, return a 404 error
            abort(404, 'Barang tidak ditemukan');
        }
    } catch (\Exception $e) {
        // Handle errors, such as connection issues or invalid responses
        abort(500, 'Terjadi kesalahan saat mengambil data barang');
    }
    

    

}
}