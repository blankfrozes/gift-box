<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function dashboard(): View
    {
        return view('pages.admin.dashboard');
    }

    public function reward(): View
    {
        return view('pages.admin.reward');
    }

    public function profile(): View
    {
        return view('pages.admin.profile');
    }

    public function voucher(): View
    {
        return view('pages.admin.voucher');
    }
}
