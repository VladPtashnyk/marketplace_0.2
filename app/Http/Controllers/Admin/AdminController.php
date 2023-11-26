<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\User;
use Illuminate\Contracts\View\View;

class AdminController extends Controller
{
    /**
     * Display a Dashboard page.
     *
     * @return View
     */
    public function dashboard(): View
    {
        return view('admin.dashboard');
    }

    /**
     * Display a listing of the Admins.
     *
     * @return View
     */
    public function admins(): View
    {
        $userModel = new User();

        $admins = $userModel->getAdmins();

        return view('admin.admins.admins', compact('admins'));
    }
}
