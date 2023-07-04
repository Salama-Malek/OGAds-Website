<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        // Retrieve the admin email using the existing method
        $adminEmail = app('App\Http\Controllers\Admin\AdminLoginController')->getLoggedInAdminEmail();

        $admin = Auth::guard('admin')->user();
        if ($admin) {
            $users = User::all();
            return view('admin.users.index', compact('users'))->with('adminEmail', $adminEmail);
        } else {
            abort(403, 'Unauthorized');
        }
    }

    public function edit($id)
    {
        // Retrieve the admin email using the existing method
        $adminEmail = app('App\Http\Controllers\Admin\AdminLoginController')->getLoggedInAdminEmail();

        $admin = Auth::guard('admin')->user();
        if ($admin) {
            $user = User::findOrFail($id);
            return view('admin.users.edit', compact('user'))->with('adminEmail', $adminEmail);
        } else {
            abort(403, 'Unauthorized');
        }
    }

    public function update(Request $request, $id)
    {
        // Retrieve the admin email using the existing method
        $adminEmail = app('App\Http\Controllers\Admin\AdminLoginController')->getLoggedInAdminEmail();

        $admin = Auth::guard('admin')->user();
        if ($admin) {
            $user = User::findOrFail($id);

            $user->player_id = $request->input('player_id');
            $user->completed_offer = $request->input('completed_offer'); // Add the completed_offer field

            $user->save();

            return redirect()->route('users.index')->with('success', 'User updated successfully')->with('adminEmail', $adminEmail);
        } else {
            abort(403, 'Unauthorized');
        }
    }

    public function destroy($id)
    {
    $adminEmail = app('App\Http\Controllers\Admin\AdminLoginController')->getLoggedInAdminEmail();

        $admin = Auth::guard('admin')->user();
        if ($admin) {
            $user = User::findOrFail($id);
            $user->delete();

            return redirect()->route('users.index')->with('success', 'User deleted successfully')->with('adminEmail', $adminEmail);
        } else {
            abort(403, 'Unauthorized');
        }
    }

    public function create()
    {
    $adminEmail = app('App\Http\Controllers\Admin\AdminLoginController')->getLoggedInAdminEmail();

        $admin = Auth::guard('admin')->user();
        if ($admin) {
            return view('admin.users.create')->with('adminEmail', $adminEmail);
        } else {
            abort(403, 'Unauthorized');
        }
    }

    public function store(Request $request)
    {
    $adminEmail = app('App\Http\Controllers\Admin\AdminLoginController')->getLoggedInAdminEmail();

        $admin = Auth::guard('admin')->user();
        if ($admin) {
            // Validate the input data
            $validatedData = $request->validate([
                'player_id' => 'required|unique:users',
            ]);

            // Create a new user
            User::create($validatedData);

            return redirect()->route('users.index')->with('success', 'User created successfully')->with('adminEmail', $adminEmail);
        } else {
            abort(403, 'Unauthorized');
        }
    }
}
