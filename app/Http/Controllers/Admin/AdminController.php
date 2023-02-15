<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('pages.admin.dashboard');
    }

    public function reward()
    {
        return view('pages.admin.reward');
    }

    public function profile()
    {
        return view('pages.admin.profile');
    }

    public function voucher()
    {
        return view('pages.admin.voucher');
    }
}
