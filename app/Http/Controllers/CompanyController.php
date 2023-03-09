<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanyProfile;
use Mail;
use DB;
// use App\Mail\CompanyRegistrationMail;

class CompanyController extends Controller
{
    public function create(){
    	return view('company_profile.create');
    }

    public function store(Request $request){
        DB::beginTransaction();
        try {
            $this->validate($request, [
                'company_name' => 'required|unique:company_profile,company_name',
                'company_correspondence_email' => 'required|email|unique:company_profile,company_correspondence_email',
                'company_correspondence_telephone' => 'required|numeric|digits:10|unique:company_profile,company_correspondence_telephone',
                'company_registration_number' => 'required|unique:company_profile,company_registration_number',
                'tax_registration_number' => 'required|unique:company_profile,tax_registration_number',
                'vat_number' => 'required|unique:company_profile,vat_number',
            ]);

            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $reset_token = generateToken($characters,32);
            
            $trim_cname = preg_replace('/\s+/', '', $request->company_name);
            $username = $this->generateTokenNew($trim_cname);
            
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

            $url = route("common.reset-password",['token'=>$reset_token,'type'=>base64_encode(1)]);
            $data = array(
                'name' => $request->company_name,
                'username' => strtoupper($username),
                'url' => $url,
                'email' => $request->company_correspondence_email
            );

            sendRegistrationMail($data,'emails.common_register_mail','Reset Password');
            DB::commit();

            return redirect()->route('common.login')->with('success_msg','Password link successfully sent it to register email id,Please check');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('customer.register')->with('error_msg','Something went wrong');
        }
    }

    public function companyProfileLogout(){
        \Auth::guard('company_profile')->logout();
        return redirect()->route('common.login');
    }

    public function generateTokenNew($combine_name){
        $three_latter_code = generateToken($combine_name,3);
        $res = CompanyProfile::where('username',$three_latter_code)->count();
        if($res>0){
            $this->generateTokenNew($combine_name);
        } else {
            return $three_latter_code;
        }
    }
}
