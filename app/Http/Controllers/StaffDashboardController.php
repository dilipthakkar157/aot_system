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

    public function editProfile(){
        $id = \Auth::guard('staff_profile')->user()->id;
        $res = StaffProfile::where('id',$id)->first();
        $rep_dob = str_replace("-",'/',$res->date_of_birth);
        $dob = date('d/m/Y', strtotime($rep_dob));
        $res->date_of_birth = $dob;
        return response()->json(['status'=>true,'messages' => 'Single successfully updated.', 'data'=>$res]);
    }

    public function updateStaff(Request $request){
        try {
            $id = \Auth::guard('staff_profile')->user()->id;
            $validator = \Validator::make($request->all(), [
                'three_letter_code' => 'required|unique:staff_profile,three_letter_code,'.$id,
                'prefix' => 'required',
                'name' => 'required',
                // 'middle_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email|unique:staff_profile,email,'.$id,
                'citizenship' => 'required',
                'date_of_birth' => 'required',
                // 'passport_id' => 'unique:staff_profile,passport_id,'.$request->id,
                'role' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['status'=>false,'messages' => $validator->errors(), 'data'=>[] ]);
            }

            if(strlen($request->three_letter_code)>3){
                $error['three_letter_code'][0] = 'Only three letter code allowed.';
                return response()->json(['status'=>false,'messages' => $error, 'data'=>[] ]);   
            }

            $rep_dob = str_replace("/",'-',$request->date_of_birth);
            $dob = date('Y-m-d', strtotime($rep_dob));

            $StaffProfile = StaffProfile::updateOrCreate(array('id' => $id));
            $StaffProfile->three_letter_code = $request->three_letter_code; 
            $StaffProfile->prefix = $request->prefix;
            $StaffProfile->name = $request->name;
            $StaffProfile->middle_name = $request->middle_name;
            $StaffProfile->last_name = $request->last_name;
            $StaffProfile->citizenship = $request->citizenship;
            $StaffProfile->date_of_birth = $dob;
            $StaffProfile->passport_id = $request->passport_id;
            $StaffProfile->role = $request->role;
            $StaffProfile->email = $request->email;
            $StaffProfile->save();

            return response()->json(['status'=>true,'messages' => 'Staff profile successfully updated.', 'data'=>[] ]);
        } catch (Exception $e) {
            return response()->json(['status'=>false,'messages' => $e->getMessage(), 'data'=>[] ]);
        }
    }
}
