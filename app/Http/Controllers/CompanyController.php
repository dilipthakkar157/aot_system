<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanyProfile;
use Mail;
// use App\Mail\CompanyRegistrationMail;

class CompanyController extends Controller
{
    public function create(){
    	return view('company_profile.create');
    }

    public function store(Request $request){
    	$this->validate($request, [
            'company_name' => 'required|unique:company_profile,company_name',
	        'company_correspondence_email' => 'required|email|unique:company_profile,company_correspondence_email',
            'company_correspondence_telephone' => 'required|numeric|digits:10|unique:company_profile,company_correspondence_telephone',
            'company_registration_number' => 'required|unique:company_profile,company_registration_number',
            'tax_registration_number' => 'required|unique:company_profile,tax_registration_number',
            'vat_number' => 'required|unique:company_profile,vat_number',
        ]);

        $length = 32;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $reset_token = '';
        for ($i = 0; $i < $length; $i++) {
            $reset_token .= $characters[random_int(0, $charactersLength - 1)];
        }

        $trim_cname = preg_replace('/\s+/', '', $request->company_name);
     	$username = substr($trim_cname, 0, 3);
        $CompanyProfile = new CompanyProfile;
        $CompanyProfile->company_name = $request->company_name;
        $CompanyProfile->username = strtoupper($username);
		$CompanyProfile->company_correspondence_email = $request->company_correspondence_email;
		$CompanyProfile->company_correspondence_telephone = $request->company_correspondence_telephone;
		$CompanyProfile->company_registration_number = $request->company_registration_number;
		$CompanyProfile->tax_registration_number = $request->tax_registration_number;
		$CompanyProfile->vat_number = $request->vat_number;
        $CompanyProfile->reset_token = $reset_token;
        $CompanyProfile->reset_token_date_time = date('Y-m-d H:i:s');
		$CompanyProfile->save();

        $url = route("company.reset-password",['token'=>$reset_token]);
        $data = array('name'=>$request->company_name,'url'=>$url,'email'=>$request->company_correspondence_email);
        \Mail::send('emails.company_register_mail', $data, function($message) use ($data) {   
            $message->to($data['email'], $data['name'])->subject
                ('Reset Password');
            $message->from('dilipthakkar157@gmail.com','Dilip Thakkar');
        });
        return redirect()->route('common.login')->with('success_msg','Password link successfully sent it to register email id,Please check');
    }

    public function resetPassword(Request $request) {
        $res = CompanyProfile::where('reset_token',$request->token)->first();
        if(!empty(($res))){
            $time = $res->reset_token_date_time;
            $new_time = $my_date_time = date('Y-m-d H:i:s', strtotime($time.' +1 hour'));
            $current_time = date('Y-m-d H:i:s');
            if(strtotime($current_time) > strtotime($new_time)) {
                return redirect()->route('common.login')->with('error_msg','Token is expired!');    
            }
            return view('company_profile.reset_password',['token'=>$request->token]);
        } else {
            return redirect()->route('common.login')->with('error_msg','Invalid token!');
        }
    }

    public function updatePassword(Request $request) {
        $this->validate($request, [
            'token' => 'required',
            'new_password' => 'required|required_with:confirm_new_password|same:confirm_new_password',
            'confirm_new_password' => 'required'
        ]);

        $res = CompanyProfile::where('reset_token',$request->token)->first();
        if(!empty(($res))){
            CompanyProfile::where('id',$res->id)->update(['password'=>\Hash::make($request->new_password),'reset_token'=>null]);
            return redirect()->route('common.login')->with('success_msg','Password Successfully reset.');
        } else {
            return redirect()->route('common.login')->with('error_msg','Invalid token!');
        }
    }

    public function companyProfileLogout(){
        \Auth::guard('company_profile')->logout();
        return redirect()->route('common.login');
    }
}
