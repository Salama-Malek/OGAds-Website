<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use App\Models\Logo;

class HomeController extends Controller
{
    public function index()
    {
        $videos = Video::all();
        $logos = Logo::all();

        return view('home', compact('videos', 'logos'));
    }
}
