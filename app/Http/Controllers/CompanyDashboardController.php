<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanyProfile;
use Hash;

class CompanyDashboardController extends Controller
{
    public function index(){
    	return view('company_profile.dashboard');
    }

    public function editProfile(){
    	$id = \Auth::guard('company_profile')->user()->id;
    	$result = CompanyProfile::where('id',$id)->first();
        return response()->json(['status'=>true,'messages' => 'Sinlge company profile data.', 'data'=>$result]);
    }

    public function updateProfile(Request $request){
    	try {
    		$id = \Auth::guard('company_profile')->user()->id;
	    	$validator = \Validator::make($request->all(), [
	            'company_name' => 'required|unique:company_profile,company_name,'.$id,
	            'company_registered_business' => 'required',
	            'zip_registered_address' => 'required|numeric|digits:6',
	            'country_registered_address' => 'required|numeric',
	            'state_registered_address' => 'required|numeric',
	            'city_registered_address' => 'required|numeric',
	            'company_correspondence_address' => 'required',
	            'zip_correspondence_address' => 'required|numeric|digits:6',
	            'country_correspondence_address' => 'required|numeric',
	            'state_correspondence_address' => 'required|numeric',
	            'city_correspondence_address' => 'required|numeric',
	            'company_correspondence_email' => 'required|email|unique:company_profile,company_correspondence_email,'.$id,
	            'company_correspondence_telephone' => 'required|numeric|digits:10|unique:company_profile,company_correspondence_telephone,'.$id,
	            'company_registration_number' => 'required|unique:company_profile,company_registration_number,'.$id,
	            'tax_registration_number' => 'required|unique:company_profile,tax_registration_number,'.$id,
	            'vat_number' => 'required|unique:company_profile,vat_number,'.$id,
	            'company_logo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
	        ]);

	        if ($validator->fails()) {
                return response()->json(['status'=>false,'messages' => $validator->errors(), 'data'=>[] ]);
            }
            $fileName = null;
            if($id>0){
                $res = CompanyProfile::where('id',$id)->select('company_logo')->first();
                $fileName = $res->company_logo;
                if($request->file('company_logo')) {
                    if($fileName!=null) {
                        $file_path = public_path().'/uploads/staff/'.$fileName;
                        unlink($file_path);
                    }
                    $fileName = time().'_'.$request->file('company_logo')->getClientOriginalName();
                    $request->file('company_logo')->move('uploads/staff',$fileName);
                }
            }

            if($request->hid_same_as_registered_business == 1){
                $company_correspondence_address = $request->company_registered_business;
                $zip_correspondence_address = $request->zip_registered_address;
                $country_correspondence_address = $request->country_registered_address;
                $state_correspondence_address = $request->state_registered_address;
                $city_correspondence_address = $request->city_registered_address;
            } else {
                $company_correspondence_address = $request->company_correspondence_address;
                $zip_correspondence_address = $request->zip_correspondence_address;
                $country_correspondence_address = $request->country_correspondence_address;
                $state_correspondence_address = $request->state_correspondence_address;
                $city_correspondence_address = $request->city_correspondence_address;
            }

            $CompanyProfile = CompanyProfile::updateOrCreate(array('id' => $id));

            $CompanyProfile->company_name = $request->company_name;
            $CompanyProfile->company_registered_business = $request->company_registered_business;
            $CompanyProfile->zip_registered_address = $request->zip_registered_address;
            $CompanyProfile->country_registered_address = $request->country_registered_address;
            $CompanyProfile->state_registered_address = $request->state_registered_address;
            $CompanyProfile->city_registered_address = $request->city_registered_address;
            $CompanyProfile->company_correspondence_address = $company_correspondence_address;
            $CompanyProfile->zip_correspondence_address = $zip_correspondence_address;
            $CompanyProfile->country_correspondence_address = $country_correspondence_address;
            $CompanyProfile->state_correspondence_address = $state_correspondence_address;
            $CompanyProfile->city_correspondence_address = $city_correspondence_address;
            $CompanyProfile->company_correspondence_email = $request->company_correspondence_email;
            $CompanyProfile->company_correspondence_telephone = $request->company_correspondence_telephone;
            $CompanyProfile->company_registration_number = $request->company_registration_number;
            $CompanyProfile->tax_registration_number = $request->tax_registration_number;
            $CompanyProfile->vat_number = $request->vat_number;
            $CompanyProfile->company_logo = $fileName;
            $CompanyProfile->save();
            return response()->json(['status'=>true,'messages' => 'Company profile successfully updated.', 'data'=>[] ]);
    	} catch (Exception $e) {
            return response()->json(['status'=>false,'messages' => $e->getMessage(), 'data'=>[] ]);
        }
    }

    public function changePassword(Request $request){
    	try {
    		$id = \Auth::guard('company_profile')->user()->id;
	    	$validator = \Validator::make($request->all(), [
	            'current_password' => 'required|min:6',
	            'new_password' => 'required|min:6|required_with:confirm_new_password|same:confirm_new_password',
	            'confirm_new_password' => 'required|min:6',
	        ]);

	        if ($validator->fails()) {
                return response()->json(['status'=>false,'messages' => $validator->errors(), 'data'=>[] ]);
            }

            $company = CompanyProfile::where('id', '=', $id)->first();
            if (!Hash::check($request->current_password, $company->password)) {
            	$errorMsg = array('current_password'=>array('Current password is invalid'));
            	return response()->json(['status'=>false,'messages' => $errorMsg, 'data'=>[] ]);
            }

            CompanyProfile::where('id', '=', $id)->update(['password'=>Hash::make($request->new_password)]);
            return response()->json(['status'=>true,'messages' => 'Password successfully updated.', 'data'=>[] ]);

	    } catch (Exception $e) {
            return response()->json(['status'=>false,'messages' => $e->getMessage(), 'data'=>[] ]);
        }
    }
}
