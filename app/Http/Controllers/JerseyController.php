<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class JerseyController extends Controller
{
    public function getJersey()
    {
        $client = new Client();
        $response = $client->get('http://127.0.0.1:8000/api/barang/kategori/jersey');
        $barang = json_decode($response->getBody()->getContents(), true);

        return view('menu.jersey', ['barang' => $barang['barang']]);
    }
}
