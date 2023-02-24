<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;

class LoginController extends Controller
{
    public function login(){
    	return view('admin.login');
    }

    public function doLogin(Request $request){

    	$this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (\Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('admin.dashboard');
        } else {
        	return redirect()->route('admin.login')->with('msg','Invalid details.');
        }
    }

    public function logout(){
        \Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
