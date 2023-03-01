<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Countries;
use App\Models\States;
use App\Models\Cities;
use App\Models\CompanyProfile;

class CommonClassController extends Controller
{
    public function getCounties(){
    	$result = Countries::get();
        return response()->json(['status'=>true,'messages' => 'Countries data.', 'data'=>$result]);
    }

    public function getStates($country_id){
    	$result = States::where('country_id',$country_id)->get();
        return response()->json(['status'=>true,'messages' => 'States data.', 'data'=>$result]);	
    }

    public function getCities($state_id){
    	$result = Cities::where('state_id',$state_id)->get();
        return response()->json(['status'=>true,'messages' => 'Cities data.', 'data'=>$result]);
    }

    public function login(){
        return view('common.login');
    }

    public function doLogin(Request $request){

        $this->validate($request, [
            'username'   => 'required',
            'password' => 'required|min:6'
        ]);

        // $check_user = CompanyProfile::where(['username'=>$request->username])->first();
        // if(!empty($check_user)){
        if (\Auth::guard('company_profile')->attempt(['username' => $request->username, 'password' => $request->password])) {
            return redirect()->route('comapany.dashboard');
        } else {
            return redirect()->route('common.login')->with('msg','Invalid details.');
        }
        // }
    }
}
