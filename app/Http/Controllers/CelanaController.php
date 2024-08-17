<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class CelanaController extends Controller
{
    public function getCelanaOlahraga()
    {
        $client = new Client();
        $response = $client->get(API_ENDPOINT . 'api/barang/kategori/celana%20olahraga');
        $barang = json_decode($response->getBody()->getContents(), true);

        return view('menu.celana', ['barang' => $barang['barang']]);
    }
}
