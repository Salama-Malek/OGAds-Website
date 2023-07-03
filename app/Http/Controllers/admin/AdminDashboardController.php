<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
class AdminDashboardController extends Controller
{
    public function index()
{
    $adminEmail = app('App\Http\Controllers\Admin\AdminLoginController')->getLoggedInAdminEmail();
    return view('admin.dashboard')->with('adminEmail', $adminEmail);
}

    
}
