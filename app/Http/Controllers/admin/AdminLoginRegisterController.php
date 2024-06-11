<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Session;
use Validator,Redirect,Response;
class AdminLoginRegisterController extends Controller
{
    public function index(){
        return view('admin.pages.admin_login');
    }
    public function loginUser(Request $request){
        request()->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::guard('admin')->attempt($credentials)) {
            $user = Auth::guard('admin');
            return redirect()->intended('admin/dashboard');
        }
        return Redirect::to("admin/login")->with('message', 'Invalid Login...!');
    }
    public function register(Request $request) {
        Admin::create(['name' => 'Admin', 'email' => 'admin@admin.com', 'password' =>bcrypt('admin@123')]);
    }
    public function logout() {
        Session::flush();
        Auth::guard('admin')->logout();
        return Redirect('admin/login');
    }
}
