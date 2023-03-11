<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Countries;
use App\Models\States;
use App\Models\Cities;
use App\Models\CompanyProfile;
use App\Models\StaffProfile;
use App\Models\StaffRole;
use App\Models\StaffRolePermission;
use App\Models\StaffAction;
use App\Models\Customer;
use DB;

class CommonClassController extends Controller
{
    public function getCounties(){
    	$result = Countries::orderBy('name','ASC')->get();
        return response()->json(['status'=>true,'messages' => 'Countries data.', 'data'=>$result]);
    }

    public function getStates($country_id){
    	$result = States::where('country_id',$country_id)->orderBy('name','ASC')->get();
        return response()->json(['status'=>true,'messages' => 'States data.', 'data'=>$result]);	
    }

    public function getCities($state_id){
    	$result = Cities::where('state_id',$state_id)->orderBy('name','ASC')->get();
        return response()->json(['status'=>true,'messages' => 'Cities data.', 'data'=>$result]);
    }

    public function getRoles(){
        $result = StaffRole::orderBy('role','ASC')->get();
        return response()->json(['status'=>true,'messages' => 'Roles data.', 'data'=>$result]);
    }

    public function getPermissions($role_id){
        $res = StaffRolePermission::where('staff_role_id',$role_id)->get();
        foreach ($res as $key => $value) {
            $action = json_decode($value->staff_action_ids,TRUE);
            $actions = StaffAction::whereIn('id',$action)->get();
            $action_arr = [];
            foreach ($actions as $key2 => $value2) {
                array_push($action_arr,$value2->action);
            }
            $res[$key]['actions'] = $action_arr;
        }
        return response()->json(['status'=>true,'messages' => 'Permission data.', 'data'=>$res]);
    }

    public function login(){
        return view('common.login');
    }

    public function doLogin(Request $request){

        $this->validate($request, [
            'username'   => 'required',
            'password' => 'required|min:6'
        ]);
        
        if (\Auth::guard('company_profile')->attempt(['three_letter_code' => $request->username, 'password' => $request->password])) {
            return redirect()->route('comapany.dashboard');
        } else if (\Auth::guard('staff_profile')->attempt(['three_letter_code' => $request->username, 'password' => $request->password])) {
            return redirect()->route('staff.dashboard');
        } else if (\Auth::guard('customer')->attempt(['three_letter_code' => $request->username, 'password' => $request->password])) {
            return redirect()->route('customer.dashboard');
        } else {
            return redirect()->route('common.login')->with('msg','Invalid details.');
        }
    }

    public function doLogout(Request $request){
        if(\Auth::guard('company_profile')->check()){
            \Auth::guard('company_profile')->logout();
        }elseif(\Auth::guard('staff_profile')->check()){
            \Auth::guard('staff_profile')->logout();
        }elseif(\Auth::guard('customer')->check()){
            \Auth::guard('customer')->logout();
        }
        return redirect()->route('common.login');
    }

    public function forgotPassword(){
        return view('common.forgotpassword');
    }

    public function doForgotpassword(Request $request){
        DB::beginTransaction();
        try {
            $this->validate($request, [
                'three_latter_code' => 'required',
                'email_id'   => 'required|email'
            ]);
            $company_flag = $staff_flag = $customer_flag = 0;
            $file = $url = '';
            $data = array();
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $reset_token = generateToken($characters,32);

            $res = CompanyProfile::where(['three_letter_code'=>$request->three_latter_code,'company_correspondence_email'=>$request->email_id])->first();
            if(!empty($res)){
                $type = 1;
                $name = $res->company_name;
                $company_flag = 1;
            } else {
                $res2 = StaffProfile::where(['three_letter_code'=>$request->three_latter_code,'email'=>$request->email_id])->first();
                if(!empty($res2)){
                    $type = 2;
                    $name = $res2->name." ".$res2->last_name;
                    $staff_flag = 1;
                } else {
                    $res3 = Customer::where(['three_letter_code'=>$request->three_latter_code,'email'=>$request->email_id])->first();
                    if(!empty($res2)){
                        $type = 3;
                        $name = $res3->name." ".$res3->last_name;
                        $customer_flag = 1;
                    } else {
                        return redirect()->route('common.forgotpassword')->with('error_msg','Invalid email id.');
                    }
                }   
            }

            if($company_flag==1 || $staff_flag==1 || $customer_flag==1){
                $url = route("common.reset-password",['token'=>$reset_token,'type'=>base64_encode($type)]);
                $data = array(
                    'name' => $name,
                    'username' => strtoupper($request->three_latter_code),
                    'url' => $url,
                    'email' => $request->email_id
                );
                sendRegistrationMail($data,'emails.common_register_mail','Reset Password');

                if($company_flag==1){
                    CompanyProfile::where(['three_letter_code'=>$request->three_latter_code,'company_correspondence_email'=>$request->email_id])->update(['reset_token'=>$reset_token,'reset_token_date_time'=>date('Y-m-d H:i:s')]);
                }elseif($staff_flag==1){
                    StaffProfile::where(['three_letter_code'=>$request->three_latter_code,'email'=>$request->email_id])->update(['reset_token'=>$reset_token,'reset_token_date_time'=>date('Y-m-d H:i:s')]);
                }elseif($customer_flag==1){
                    Customer::where(['three_letter_code'=>$request->three_latter_code,'email'=>$request->email_id])->update(['reset_token'=>$reset_token,'reset_token_date_time'=>date('Y-m-d H:i:s')]);
                }
                DB::commit();
                return redirect()->route('common.forgotpassword')->with('success_msg','Password link successfully sent it to register email id,Please check');
            }

        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('customer.register')->with('error_msg','Something went wrong');
        }
    }

    public function resetPassword(Request $request) {
        $errorFlag = $successFlag = 0;
        $data = [];
        $type = base64_decode($request->type);
        if($type == 3){ //Customer
            $obj = new Customer;
        } elseif($type == 1){ //Company
            $obj = new CompanyProfile;
        } elseif($type == 2){ //Staff
            $obj = new StaffProfile;
        }

        $res = $obj::where('reset_token',$request->token)->first();
        if(!empty(($res))) {
            $time = $res->reset_token_date_time;
            $new_time = $my_date_time = date('Y-m-d H:i:s', strtotime($time.' +1 hour'));
            $current_time = date('Y-m-d H:i:s');
            if(strtotime($current_time) > strtotime($new_time)) {
                $errorFlag=1;
                $msg = 'Token is expired!';
            }
            $successFlag=1;
            $data = ['token'=>$request->token,'type'=>base64_encode($type)];
        } else {
            $errorFlag=1;
            $msg = 'Invalid token!';
        }

        if($errorFlag == 1){
            return redirect()->route('common.login')->with('error_msg',$msg);
        }
        if($successFlag == 1){
            return view('common.reset_password',$data);
        }
    }

    public function updatePassword(Request $request) {
        try {
            $this->validate($request, [
                'token' => 'required',
                'type' => 'required',
                'three_latter_code' => 'required',
                'email' => 'required|email',
                'new_password' => 'required|required_with:confirm_new_password|same:confirm_new_password',
                'confirm_new_password' => 'required'
            ]);
            $type = base64_decode($request->type);
            if($type == 3){ //Customer
                $obj = new Customer;
                $db_email_field = 'email';
            }elseif($type == 1){ //Company
                $obj = new CompanyProfile;
                $db_email_field = 'company_correspondence_email';
            }elseif($type == 2){ //Staff
                $obj = new StaffProfile;
                $db_email_field = 'email';
            }

            $res = $obj::where([$db_email_field=>$request->email,'three_letter_code'=>$request->three_latter_code,'reset_token'=>$request->token]);
            $res1 = $res->first();
            if(!empty($res1)){
                $res->update(['password'=>\Hash::make($request->new_password),'reset_token'=>null]);
                return redirect()->route('common.login')->with('success_msg','Password Successfully reset.');
            } else {
                return redirect()->route('common.login')->with('error_msg','Data not match');           
            }
        } catch (Exception $e) {
            return redirect()->route('customer.login')->with('error_msg','Something went wrong');
        }
    }

    public function changePassword(Request $request){
        try {
	    	$validator = \Validator::make($request->all(), [
	            'type' => 'required',
                'current_password' => 'required|min:6',
	            'new_password' => 'required|min:6|required_with:confirm_new_password|same:confirm_new_password',
	            'confirm_new_password' => 'required|min:6',
	        ]);

	        if ($validator->fails()) {
                return response()->json(['status'=>false,'messages' => $validator->errors(), 'data'=>[] ]);
            }

            if($request->type == 1){
    		    $id = \Auth::guard('company_profile')->user()->id;
                $obj = new CompanyProfile;
            }else if($request->type == 2){
                $id = \Auth::guard('staff_profile')->user()->id;
                $obj = new StaffProfile;
            }else if($request->type == 3){
                $id = \Auth::guard('customer')->user()->id;
                $obj = new Customer;
            }

            $res = $obj::where('id', '=', $id)->first();
            if (!Hash::check($request->current_password, $res->password)) {
            	$errorMsg = array('current_password'=>array('Current password is invalid'));
            	return response()->json(['status'=>false,'messages' => $errorMsg, 'data'=>[] ]);
            }

            $obj::where('id', '=', $id)->update(['password'=>Hash::make($request->new_password)]);
            return response()->json(['status'=>true,'messages' => 'Password successfully updated.', 'data'=>[] ]);

	    } catch (Exception $e) {
            return response()->json(['status'=>false,'messages' => $e->getMessage(), 'data'=>[] ]);
        }
    }
}
