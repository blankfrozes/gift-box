<?php

namespace App\Http\Controllers\Admin;

use Illuminate\View\View;
use App\Http\Controllers\Controller;

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
