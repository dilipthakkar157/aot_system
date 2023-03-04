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
        
        if (\Auth::guard('company_profile')->attempt(['username' => $request->username, 'password' => $request->password])) {
            return redirect()->route('comapany.dashboard');
        } else {
            if (\Auth::guard('staff_profile')->attempt(['three_letter_code' => $request->username, 'password' => $request->password])) {
                return redirect()->route('staff.dashboard');
            } else {
                return redirect()->route('common.login')->with('msg','Invalid details.');
            }
        }
    }

    public function forgotPassword(){
        return view('common.forgotpassword');
    }

    public function doForgotpassword(Request $request){
        $this->validate($request, [
            'email_id'   => 'required|email'
        ]);
        $company_flag = $staff_flag = 0;
        $file = $url = '';
        $data = array();
        $length = 32;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $reset_token = '';
        for ($i = 0; $i < $length; $i++) {
            $reset_token .= $characters[random_int(0, $charactersLength - 1)];
        }

        $res = CompanyProfile::where('company_correspondence_email',$request->email_id)->first();
        if(!empty($res)){
            
            $url = route("company.reset-password",['token'=>$reset_token]);
            $data = array('name'=>$res->company_name,'url'=>$url,'email'=>$res->company_correspondence_email);
            $file = 'emails.company_register_mail';
            $company_flag = 1;
        } else {
            $res = StaffProfile::where('email',$request->email_id)->first();
            if(!empty($res)){
                $url = route("staff.reset-password",['token'=>$reset_token]);
                $data = array('name'=>$res->name." ".$res->last_name,'url'=>$url,'email'=>$res->email);
                $file = 'emails.staff_register_mail';
                $staff_flag = 1;
            } else {
                return redirect()->route('common.forgotpassword')->with('error_msg','Invalid email id.');
            }   
        }

        if($company_flag==1 || $staff_flag==1){
            \Mail::send($file, $data, function($message) use ($data) {   
                $message->to($data['email'], $data['name'])->subject
                    ('Reset Password');
                $message->from('dilipthakkar157@gmail.com','Dilip Thakkar');
            });
            if($company_flag==1){
                CompanyProfile::where('company_correspondence_email',$request->email_id)->update(['reset_token'=>$reset_token,'reset_token_date_time'=>date('Y-m-d H:i:s')]);
            }elseif($staff_flag==1){
                StaffProfile::where('email',$request->email_id)->update(['reset_token'=>$reset_token,'reset_token_date_time'=>date('Y-m-d H:i:s')]);
            }

            return redirect()->route('common.forgotpassword')->with('success_msg','Password link successfully sent it to register email id,Please check');
        }
    }
}
