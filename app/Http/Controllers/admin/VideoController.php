<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
    public function index()
    {
    $adminEmail = app('App\Http\Controllers\Admin\AdminLoginController')->getLoggedInAdminEmail();

        $admin = Auth::guard('admin')->user();
        if ($admin) {
            $videos = $admin->videos;
            return view('admin.videos.index', compact('videos'))->with('adminEmail', $adminEmail);
        } else {
            abort(403, 'Unauthorized');
        }
    }

    public function create()
    {
    $adminEmail = app('App\Http\Controllers\Admin\AdminLoginController')->getLoggedInAdminEmail();

        $admin = Auth::guard('admin')->user();
        if ($admin) {
            return view('admin.videos.create')->with('adminEmail', $adminEmail);
        } else {
            abort(403, 'Unauthorized');
        }
    }

    public function store(Request $request)
    {
    $adminEmail = app('App\Http\Controllers\Admin\AdminLoginController')->getLoggedInAdminEmail();

        $admin = Auth::guard('admin')->user();
        if ($admin) {
            $request->validate([
                'url' => 'required|url',
            ]);

            $video = new Video();
            $video->url = $request->input('url');
            $video->admin_id = auth()->guard('admin')->user()->id; // Assign the admin's ID
            $video->save();

            return redirect()->route('videos.index')->with('success', 'Video created successfully.')->with('adminEmail', $adminEmail);
        } else {
            abort(403, 'Unauthorized');
        }
    }

    public function edit(Video $video)
    {
    $adminEmail = app('App\Http\Controllers\Admin\AdminLoginController')->getLoggedInAdminEmail();

        $admin = Auth::guard('admin')->user();
        if ($admin) {
            return view('admin.videos.edit', compact('video'))->with('adminEmail', $adminEmail);
        } else {
            abort(403, 'Unauthorized');
        }
    }

    public function update(Request $request, Video $video)
    {
    $adminEmail = app('App\Http\Controllers\Admin\AdminLoginController')->getLoggedInAdminEmail();

        $admin = Auth::guard('admin')->user();
        if ($admin) {
            $request->validate([
                'url' => 'required|url',
            ]);

            $video->url = $request->input('url');
            $video->save();

            return redirect()->route('videos.index')->with('success', 'Video updated successfully.')->with('adminEmail', $adminEmail);
        } else {
            abort(403, 'Unauthorized');
        }
    }

    public function destroy(Video $video)
    {
    $adminEmail = app('App\Http\Controllers\Admin\AdminLoginController')->getLoggedInAdminEmail();

        $admin = Auth::guard('admin')->user();
        if ($admin) {
            $video->delete();

            return redirect()->route('videos.index')->with('success', 'Video deleted successfully.');
        } else {
            abort(403, 'Unauthorized');
        }
    }
}
