<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Code;
use Faker\Factory as Faker;


class OfferController extends Controller
{
    public function index(Request $request)
    {
        $apiKey = env('OGADS_API_KEY');

        // $response = Http::get('https://api.ipify.org/?format=json');
        // $data = $response->json();

        // if (isset($data['ip'])) {
        //     $ip = $data['ip'];
        // } else {
        //     throw new \Exception('Failed to retrieve IP address');
        // }
        $ip = $request->ip(); // Get the visitor's IP address

        $data = [
            'ip' => $ip,
            'user_agent' => $request->header('User-Agent'), // Client User Agent (REQUIRED)
        ];

        $url = 'https://unlockcontent.net/api/v2?' . http_build_query($data);

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
            ])->withOptions([
                'verify' => storage_path('certificates/cacert.pem'),
            ])->get($url);

            $response->throw();

            $content = $response->json();

            if ($content['success']) {
                $offers = $content['offers'];
                // $faker = Faker::create();
                // $offers = [];
                // for ($i = 1; $i <= 20; $i++) {
                //     $offer = [
                //         'name_short' => 'Offer ' . $i . ' - ' . $faker->sentence(3),
                //         'picture' => $faker->imageUrl(),
                //         'link' => $faker->url(),
                //     ];
                //     $offers[] = $offer;
                // }
                return view('offer', ['offers' => $offers]);
            } else {
                throw new \Exception($content['error']);
            }
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage(), $exception->getCode());
        }
    }
    public function getCode()
    {
        $playerId = session('player_id');

        $user = User::where('player_id', $playerId)->first();

        if ($user && !$user->completed_offer) {
            $partialCode = substr(Code::first()->code, 0, 3);
            $remainingAsterisks = 7; // Assuming the code length is 10 characters
        } else {
            $partialCode = Code::first()->code;
            $remainingAsterisks = 0;
        }

        return compact('partialCode', 'remainingAsterisks');
    }
}
