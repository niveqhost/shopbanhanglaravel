<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class UserController extends Controller
{
    public function login() {
        return view('login');
    }

    public function logout() {
        return view('index');
    }

    public function adminDashboard(Request $request) {
        $admin_email = $request->admin_email;
        $admin_password = md5($request->admin_password);
        $adminAccount = DB::table('admin')->where("admin_email", $admin_email)->where("admin_password", $admin_password)->first();
        if($adminAccount) {
            $request->session()->put('admin_name', $adminAccount->admin_name);
            $request->session()->put('admin_id', $adminAccount->admin_id);
            return view("admin.dashboard");
        }
        else {
            return Redirect::to('/login');
        }
    }
}
