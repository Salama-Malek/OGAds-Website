<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use App\Models\Logo;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index()
    {
        $videos = Video::all();
        $logos = Logo::all();
        return view('home', compact('videos', 'logos'));
    }
    public function handleLoginButtonClick(Request $request)
    {
        // Step 1: Validate the input
        $validator = Validator::make($request->all(), [
            'login_input' => 'required|numeric', // Add your desired validation rules here
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $playerId = $request->input('login_input');
        $user = User::where('player_id', $playerId)->first();

        // Step 2: If the user exists, store the player_id in the session or local storage
        if ($user) {
            session(['player_id' => $playerId]); // Store player_id in the session
            // Alternatively, you can use local storage to store player_id in JavaScript if needed
        } else {
            // Step 3: If the user does not exist, register the user in the database
            $user = new User();
            $user->player_id = $playerId;
            $user->completed_offer = false;
            $user->save();

            // Store the player_id in the session or local storage
            session(['player_id' => $playerId]);
            // Alternatively, you can use local storage to store player_id in JavaScript if needed
        }

        // Step 4: Redirect the user to the "offers" view
        return redirect()->route('offer.index');
    }
}
