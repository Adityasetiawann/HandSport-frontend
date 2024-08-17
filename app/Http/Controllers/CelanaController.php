<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class CelanaController extends Controller
{
    public function getCelanaOlahraga()
    {
        $client = new Client();
        $response = $client->get('http://127.0.0.1:8000/api/barang/kategori/celana%20olahraga');
        $barang = json_decode($response->getBody()->getContents(), true);

        return view('menu.celana', ['barang' => $barang['barang']]);
    }
}
