<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Code;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdminCodeController extends Controller
{

    public function index()
    {
    $adminEmail = app('App\Http\Controllers\Admin\AdminLoginController')->getLoggedInAdminEmail();


        $admin = Auth::guard('admin')->user();
        if ($admin) {
            $codes = Code::all();
            return view('admin.codes.index', compact('codes'))->with('adminEmail', $adminEmail);
        } else {
            abort(403, 'Unauthorized');
        }
    }

    public function edit($id)
    {
    $adminEmail = app('App\Http\Controllers\Admin\AdminLoginController')->getLoggedInAdminEmail();

        $admin = Auth::guard('admin')->user();
        if ($admin) {
            $code = Code::findOrFail($id);
            return view('admin.codes.edit', compact('code'))->with('adminEmail', $adminEmail);
        } else {
            abort(403, 'Unauthorized');
        }
    }

    public function update(Request $request, $id)
    {
    $adminEmail = app('App\Http\Controllers\Admin\AdminLoginController')->getLoggedInAdminEmail();

        $admin = Auth::guard('admin')->user();
        if ($admin) {
            $code = Code::findOrFail($id);

            $code->code = $request->input('code');

            $code->save();

            return redirect()->route('codes.index')->with('success', 'Code updated successfully')->with('adminEmail', $adminEmail);
        } else {
            abort(403, 'Unauthorized');
        }
    }

    public function destroy($id)
    {
    $adminEmail = app('App\Http\Controllers\Admin\AdminLoginController')->getLoggedInAdminEmail();

        $admin = Auth::guard('admin')->user();
        if ($admin) {
            $code = Code::findOrFail($id);
            $code->delete();

            return redirect()->route('codes.index')->with('success', 'Code deleted successfully')->with('adminEmail', $adminEmail);
        } else {
            abort(403, 'Unauthorized');
        }
    }

    public function create()
    {
    $adminEmail = app('App\Http\Controllers\Admin\AdminLoginController')->getLoggedInAdminEmail();

        $admin = Auth::guard('admin')->user();
        if ($admin) {
            return view('admin.codes.create')->with('adminEmail', $adminEmail);
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
                'code' => 'required|unique:codes',
            ]);

            // Create a new user
            Code::create($validatedData);

            return redirect()->route('codes.index')->with('success', 'User created successfully')->with('adminEmail', $adminEmail);
        } else {
            abort(403, 'Unauthorized');
        }
    }
}
