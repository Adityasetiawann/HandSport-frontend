<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class ShopController extends Controller
{

    public function index()
    {
        try {
            $client = new Client();
            $response = $client->get(API_ENDPOINT . 'api/barang', [
                'query' => ['kategori' => 'Jersey']
            ]);

            $data = json_decode($response->getBody(), true);

            return view('frontend.shop.index', ['barang' => $data['barang']]);
        } catch (RequestException $e) {
            // Log the error or handle it as needed
            return view('frontend.shop.index', ['barang' => []]);
        }
    }
   
   
   
   
    // public function index()
    // {
    //     try {
    //         $client = new Client();
    //         $response = $client->get(API_ENDPOINT . 'api/barang?kategori=jersey');
    //         $data = json_decode($response->getBody(), true);

    //         return view('frontend.shop.index', ['barang' => $data['barang']]);
    //     } catch (RequestException $e) {
    //         // Log the error or handle it as needed
    //         return view('frontend.shop.index', ['barang' => []]);
    //     }
    // }



    // public function index()
    // {
    //     $client = new Client();
    //     $response = $client->get(API_ENDPOINT . 'api/barang');
    //     $data = json_decode($response->getBody(), true);

    //     return view('frontend.shop.index', ['barang' => $data['barang']]);
    // }
    
}
