<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Exception;
use Illuminate\Http\Client\RequestException;

class OffersController extends Controller
{
    public function index(Request $request)
    {
        // Retrieve the API key from the .env file
        $apiKey = env('OGADS_API_KEY');
        $ip = env('MY_PUBLIC_IP');

        // Setup request data
        $data = [
            'ip' => $ip,
            'user_agent' => $request->header('User-Agent'), // Client User Agent (REQUIRED)
            // Enter other optional vars here (ctype, max, etc)
        ];

        // Build the URL
        $url = 'https://unlockcontent.net/api/v2?' . http_build_query($data);

        try {
            // Make the API request
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
            ])->withOptions([
                'verify' => storage_path('certificates/cacert.pem'),
            ])->get($url,);
            // Check for request error
            $response->throw();

            // Parse JSON response
            $content = $response->json();

            if ($content['success']) {
                // If API response reported success...
                $offers = $content['offers'];
                // Do something with $offers
                dd($offers);
                // dd($offers[0]['link']);
                // dd($offers[0]['picture']);

                return view('offers', ['offers' => $offers]);
            } else {
                // If API response reported an error...
                throw new \Exception($content['error']);
            }
        } catch (RequestException $exception) {
            // Handle HTTP request error
            throw new \Exception($exception->getMessage(), $exception->getCode());
        }
        
    }

   
}

