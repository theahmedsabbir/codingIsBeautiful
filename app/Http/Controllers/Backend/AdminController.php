<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Session;

class AdminController extends Controller
{
    public function loginForm()
    {
        return view('backend.auth.login');
    }

    public function login(Request $request){
    	//return $request->all();

        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        //if admin table credential matches put id/details on the session
        $admin = Admin::where('email' ,$request->email)->first();


  		if ($admin){
            if (password_verify($request->password, $admin->password)) {
                Session::put('admin_id', $admin->id);
                Session::put('admin_name', $admin->name);

                session()->flash('Success', 'You are successfully logged in');
                return redirect('/admin/dashboard');
            }else {
        		session()->flash('Error', 'Password does not match');
                return redirect()->back();
            }
        }else {
        	session()->flash('Error', 'Email does not match');
            return redirect()->back();
        }
        //redirect to dashboard

    }

    public function dashboard()
    {
    	return view('backend.home.index');
    }


    public function logout(Request $request)
    {
    	$request->session()->flush();
    	return redirect('admin/login');
    }
}
