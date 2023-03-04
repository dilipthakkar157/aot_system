<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StaffProfile;
use Hash;

class StaffDashboardController extends Controller
{
    public function index(){
    	return view('staff_profile.dashboard');
    }

    public function logout(){
    	\Auth::guard('staff_profile')->logout();
        return redirect()->route('common.login');
    }

    public function changePassword(Request $request){
    	try {
    		$id = \Auth::guard('staff_profile')->user()->id;
	    	$validator = \Validator::make($request->all(), [
	            'current_password' => 'required|min:6',
	            'new_password' => 'required|min:6|required_with:confirm_new_password|same:confirm_new_password',
	            'confirm_new_password' => 'required|min:6',
	        ]);

	        if ($validator->fails()) {
                return response()->json(['status'=>false,'messages' => $validator->errors(), 'data'=>[] ]);
            }

            $staff = StaffProfile::where('id', '=', $id)->first();
            if (!Hash::check($request->current_password, $staff->password)) {
            	$errorMsg = array('current_password'=>array('Current password is invalid'));
            	return response()->json(['status'=>false,'messages' => $errorMsg, 'data'=>[] ]);
            }

            StaffProfile::where('id', '=', $id)->update(['password'=>Hash::make($request->new_password)]);
            return response()->json(['status'=>true,'messages' => 'Password successfully updated.', 'data'=>[] ]);

	    } catch (Exception $e) {
            return response()->json(['status'=>false,'messages' => $e->getMessage(), 'data'=>[] ]);
        }
    }
}
