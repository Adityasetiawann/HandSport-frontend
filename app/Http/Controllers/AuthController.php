<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;


class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        try {
            $client = new Client();
            $response = $client->post(API_ENDPOINT . 'api/register', [
                'json' => [
                    'username' => $request->username,
                    'email' => $request->email,
                    'password' => $request->password,
                ],
            ]);

            if ($response->getStatusCode() == 201) {
                return redirect('/login')->with('success', 'Registration successful. Please login.');
            }
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Registration failed. Please try again.']);
        }
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        try {
            $client = new Client();
            $response = $client->post(API_ENDPOINT . 'api/login', [
                'json' => [
                    'email' => $request->email,
                    'password' => $request->password,
                ],
            ]);

            if ($response->getStatusCode() == 200) {
                $data = json_decode($response->getBody(), true);
                Session::put('access_token', $data['access_token']);


                $client = new Client();
                $response = $client->get(API_ENDPOINT . 'api/user', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $data['access_token'],
                    ],
                ]);

                $userData = json_decode($response->getBody(), true);
                Session::put('user_name', $userData['username']);

                if ($userData['role'] == 'user') {
                    return redirect('/shop');
                } else {
                    Session::forget('access_token');
                    return back()->withErrors(['message' => 'You are not authorized to access the dashboard.']);
                }
            }
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Login failed. Please check your credentials and try again.']);
        }
    }

    // public function dashboard()
    // {
    //     return view('dashboard');
    // }

    public function logout(Request $request)
    {
        try {
            $client = new Client();
            $response = $client->post(API_ENDPOINT . 'api/logout', [
                'headers' => [
                    'Authorization' => 'Bearer ' . Session::get('access_token'),
                ],
            ]);

            if ($response->getStatusCode() == 200) {
                Session::forget('access_token');
                return redirect('/')->with('success', 'Logged out successfully.');
            }
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Logout failed. Please try again.']);
        }
    }
}
