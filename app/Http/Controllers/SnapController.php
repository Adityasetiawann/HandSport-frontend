<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use App\Veritrans\Midtrans;
use App\Exceptions\VeritransException as Exception;

class SnapController extends Controller
{
    public function __construct()
    {   
        Midtrans::$serverKey = 'SB-Mid-server-KSIKcMYr-OhqH2h6g1_BQGKe';
        //set is production to true for production mode
        Midtrans::$isProduction = false;
    }

    public function snap()
    {
        return view('snap_checkout');
    }

    public function token() 
    {
        $client = new Client();
        $midtrans = new Midtrans;
        $authToken = Session::get('access_token');
        $name = Session::get('user_name');

        try {
            $response = $client->get(API_ENDPOINT . 'api/pesananDetail', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $authToken,
                    'Accept' => 'application/json',
                ],
            ]);
    
            $data = json_decode($response->getBody()->getContents(), true);
            $cartItems = $data['cart_items'];
            $collection = collect($data['cart_items']);
            $total = $collection->sum('total');
            
            $transaction_details = array(
                'order_id'      => uniqid(),
                'gross_amount'  => $total
            );
    

            $items = [];
            foreach ($cartItems as $item) {
                $items[] = [
                    'id'        => $item['id'],
                    'price'     => $item['total'],
                    'quantity'  => $item['quantity'],
                    'name'      => $item['barang']['nama_barang'],
                ];
            }
    

            // Populate customer's billing address
            $billing_address = array(
                'first_name'    => $name,
                // 'last_name'     => "",
                // 'address'       => "",
                // 'city'          => "",
                // 'postal_code'   => "",
                // 'phone'         => "",
                // 'country_code'  => 'IDN'
                );
    
            // Populate customer's shipping address
            $shipping_address = array(
                'first_name'    => $name,
                // 'last_name'     => "",
                // 'address'       => "",
                // 'city'          => "",
                // 'postal_code'   => "",
                // 'phone'         => "",
                // 'country_code'  => 'IDN'
                );
    
            // Populate customer's Info
            $customer_details = array(
                'first_name'      => $name,
                // 'last_name'       => "",
                // 'email'           => $user->email,
                // 'phone'           => "",
                'billing_address' => $billing_address,
                'shipping_address'=> $shipping_address
                );
    
            // Data yang akan dikirim untuk request redirect_url.
            $credit_card['secure'] = true;
            //ser save_card true to enable oneclick or 2click
            //$credit_card['save_card'] = true;
    
            $time = time();
            $custom_expiry = array(
                'start_time' => date("Y-m-d H:i:s O",$time),
                'unit'       => 'hour', 
                'duration'   => 1
            );
            
            $transaction_data = array(
                'transaction_details'=> $transaction_details,
                'item_details'       => $items,
                'customer_details'   => $customer_details,
                'credit_card'        => $credit_card,
                'expiry'             => $custom_expiry
            );
        
            try
            {
                $snap_token = $midtrans->getSnapToken($transaction_data);
                //return redirect($vtweb_url);
                echo $snap_token;
            } 
            catch (Exception $e) 
            {   
                return $e->getMessage;
            }
    
        } catch (\Exception $e) {
             return response()->json(['message' => 'Keranjang belanja kosong'], 400);
        }
    }

    public function finish(Request $request)
    {
        $result = $request->input('result_data');
        $result = json_decode($result);
       
        $client = new Client();
        $token = Session::get('access_token'); // Ambil token dari sesi

        try {
            $response = $client->post(API_ENDPOINT . 'api/store-pesanan', [
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

}    