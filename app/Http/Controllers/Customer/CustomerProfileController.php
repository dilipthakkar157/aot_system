<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use DB;
use PDF;

class CustomerProfileController extends Controller
{
    public function registration(){
        return view('customer_profile.registration');
    }

    public function doRegistration(Request $request){
        DB::beginTransaction();
        try {
            $this->validate($request, [
                'first_name' => 'required',
                'middle_name' => 'required',
                'last_name' => 'required',
                'date_of_birth' => 'required',
                'place_of_birth' => 'required',
                'social_security_number' => 'required|unique:customers,social_security_number',
                'email' => 'required|unique:customers,email',
            ]);

            if($request->is_tc_accepted == "0") {
                return redirect()->route('customer.register')->with('error_msg','Please accept T&C');
            }

            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $reset_token = generateToken($characters,32);

            $trim_fname = preg_replace('/\s+/', '', $request->first_name);
            $trim_mname = preg_replace('/\s+/', '', $request->middle_name);
            $trim_lname = preg_replace('/\s+/', '', $request->last_name);

            $combine_name = $trim_fname."".$trim_mname."".$trim_lname;
            $three_latter_code = $this->generateTokenNew($combine_name);

            $rep_dob = str_replace("/",'-',$request->date_of_birth);
	        $dob = date('Y-m-d', strtotime($rep_dob));
            
            $Customer = new Customer;
            $Customer->company_id = 0;
            $Customer->first_name = $request->first_name;
            $Customer->middle_name = $request->middle_name;
            $Customer->last_name = $request->last_name;
            $Customer->date_of_birth = $dob;
            $Customer->place_of_birth = $request->place_of_birth;
            $Customer->social_security_number = $request->social_security_number;
            $Customer->email = $request->email;
            $Customer->three_letter_code = strtoupper($three_latter_code);
            $Customer->reset_token = $reset_token;
            $Customer->reset_token_date_time = date('Y-m-d H:i:s');
            $Customer->save();

            $url = route("common.reset-password",['token'=>$reset_token,'type'=>base64_encode(3)]);
            $data = array(
                'name' => $trim_fname." ".$trim_lname,
                'username' => strtoupper($three_latter_code),
                'url' => $url,
                'email' => $request->email
            );
            sendRegistrationMail($data,'emails.common_register_mail','Reset Password');
            DB::commit();

            $data = Customer::where('id',$Customer->id)->first();
            $rep_dob = str_replace("-",'/',$data->date_of_birth);
            $dob = date('d/m/Y', strtotime($rep_dob));
            $data->date_of_birth = $dob;
            $pdf = PDF::loadView('customer_profile.customer_pdf_data', ['data'=>$data]);
            return $pdf->download($data->first_name.".pdf");

            return redirect()->route('common.login')->with('success_msg','Password link successfully sent it to register email id,Please check');

        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('customer.register')->with('error_msg','Something went wrong');
        }
    }

    // public function resetPassword(Request $request) {
    //     $res = Customer::where('reset_token',$request->token)->first();
    //     if(!empty(($res))){
    //         $time = $res->reset_token_date_time;
    //         $new_time = $my_date_time = date('Y-m-d H:i:s', strtotime($time.' +1 hour'));
    //         $current_time = date('Y-m-d H:i:s');
    //         if(strtotime($current_time) > strtotime($new_time)) {
    //             return redirect()->route('common.login')->with('error_msg','Token is expired!');    
    //         }
    //         return view('customer.reset_password',['token'=>$request->token]);
    //     } else {
    //         return redirect()->route('common.login')->with('error_msg','Invalid token!');
    //     }
    // }

    public function generateTokenNew($combine_name){
        $three_latter_code = generateToken($combine_name,3);
        $res = Customer::where('three_letter_code',$three_latter_code)->count();
        if($res>0){
            $this->generateTokenNew($combine_name);
        } else {
            return $three_latter_code;
        }
    }

    // public function generatePDF($customer_id){
    //     $data = Customer::where('id',$customer_id)->first();
    //     $rep_dob = str_replace("-",'/',$data->date_of_birth);
	//     $dob = date('d/m/Y', strtotime($rep_dob));
    //     $data->date_of_birth = $dob;
    //     $pdf = PDF::loadView('customer_profile.customer_pdf_data', ['data'=>$data]);
    //     $pdf->download('customer.pdf');
    // }
}
