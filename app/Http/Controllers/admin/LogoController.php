<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Logo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LogoController extends Controller
{
    public function index()
    {
        $adminEmail = app('App\Http\Controllers\Admin\AdminLoginController')->getLoggedInAdminEmail();

        $admin = Auth::guard('admin')->user();
        if ($admin) {
            $logos = Logo::all();
            return view('admin.logos.index', compact('logos'))->with('adminEmail', $adminEmail);
        } else {
            abort(403, 'Unauthorized');
        }
    }

    public function create()
    {
        $adminEmail = app('App\Http\Controllers\Admin\AdminLoginController')->getLoggedInAdminEmail();

        $admin = Auth::guard('admin')->user();
        if ($admin) {
            return view('admin.logos.create')->with('adminEmail', $adminEmail);
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
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $logo = new Logo;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('logos', $imageName, 'public'); // Store the image in the "logos" folder inside the "storage/app/public" directory
                $logo->image = $imageName;
            }

            $logo->save();

            return redirect()->route('logos.index')->with('success', 'Logo added successfully')->with('adminEmail', $adminEmail);
        } else {
            abort(403, 'Unauthorized');
        }
    }

    public function edit($id)
    {
        $adminEmail = app('App\Http\Controllers\Admin\AdminLoginController')->getLoggedInAdminEmail();

        $admin = Auth::guard('admin')->user();
        if ($admin) {
            $logo = Logo::find($id);
            return view('admin.logos.edit', compact('logo'))->with('adminEmail', $adminEmail);
        } else {
            abort(403, 'Unauthorized');
        }
    }

    public function update(Request $request, $id)
    {
        $adminEmail = app('App\Http\Controllers\Admin\AdminLoginController')->getLoggedInAdminEmail();

        $admin = Auth::guard('admin')->user();
        if ($admin) {
            $logo = Logo::find($id);

            $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('logos', $imageName, 'public'); // Store the image in the "logos" folder inside the "storage/app/public" directory
                $logo->image = $imageName;
            }

            $logo->save();

            return redirect()->route('logos.index')->with('success', 'Logo updated successfully')->with('adminEmail', $adminEmail);
        } else {
            abort(403, 'Unauthorized');
        }
    }

    public function destroy($id)
    {
        $adminEmail = app('App\Http\Controllers\Admin\AdminLoginController')->getLoggedInAdminEmail();

        $admin = Auth::guard('admin')->user();
        if ($admin) {
            $logo = Logo::find($id);

            // Delete the image file from the "logos" folder
            Storage::disk('public')->delete('logos/' . $logo->image);

            $logo->delete();

            return redirect()->route('logos.index')->with('success', 'Logo deleted successfully')->with('adminEmail', $adminEmail);
        } else {
            abort(403, 'Unauthorized');
        }
    }
}
