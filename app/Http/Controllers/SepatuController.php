<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class SepatuController extends Controller
{
    public function getSepatu()
    {
        $client = new Client();
        $response = $client->get('http://127.0.0.1:8000/api/barang/kategori/sepatu');
        $barang = json_decode($response->getBody()->getContents(), true);

        return view('menu.sepatu', ['barang' => $barang['barang']]);
    }

}
