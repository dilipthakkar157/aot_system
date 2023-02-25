<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CompanyProfile;

class CompanyProfileController extends Controller
{
    public function index() {
    	return view('admin.company_profile.list');
    }

    public function list() {
        $result = CompanyProfile::with('registered_country','registered_state','registered_city','correspondence_country','correspondence_state','correspondence_city')->get();
        if(count($result)>0){
            foreach ($result as $key => $company_profile) {
                $result[$key]['country_registered_address'] = (isset($company_profile->registered_country)) ? $company_profile->registered_country->name : '-';
                $result[$key]['state_registered_address'] = (isset($company_profile->registered_state)) ? $company_profile->registered_state->name : '-';
                $result[$key]['city_registered_address'] = (isset($company_profile->registered_city)) ? $company_profile->registered_city->name : '-';
                $result[$key]['country_correspondence_address'] = (isset($company_profile->correspondence_country)) ? $company_profile->correspondence_country->name : '-';
                $result[$key]['state_correspondence_address'] = (isset($company_profile->correspondence_state)) ? $company_profile->correspondence_state->name : '-';
                $result[$key]['city_correspondence_address'] = (isset($company_profile->correspondence_city)) ? $company_profile->correspondence_city->name : '-';
            }
        }
        return response()->json(['status'=>true,'messages' => 'Company profile data.', 'data'=>$result]);
    }

    public function edit($id) {
        $result = CompanyProfile::where('id',$id)->first();
        return response()->json(['status'=>true,'messages' => 'Sinlge company profile data.', 'data'=>$result]);
    }

    public function update(Request $request) {
        try {
            $validator = \Validator::make($request->all(), [
                'id' => 'required|numeric',
                'company_name' => 'required|unique:company_profile,company_name,'.$request->id,
                'company_registered_business' => 'required',
                'zip_registered_address' => 'required|numeric',
                'country_registered_address' => 'required|numeric',
                'state_registered_address' => 'required|numeric',
                'city_registered_address' => 'required|numeric',
                'company_correspondence_address' => 'required',
                'zip_correspondence_address' => 'required|numeric',
                'country_correspondence_address' => 'required|numeric',
                'state_correspondence_address' => 'required|numeric',
                'city_correspondence_address' => 'required|numeric',
                'company_correspondence_email' => 'required|email|unique:company_profile,company_correspondence_email,'.$request->id,
                'company_correspondence_telephone' => 'required|unique:company_profile,company_correspondence_telephone,'.$request->id,
                'company_registration_number' => 'required|unique:company_profile,company_registration_number,'.$request->id,
                'tax_registration_number' => 'required|unique:company_profile,tax_registration_number,'.$request->id,
                'vat_number' => 'required|unique:company_profile,vat_number,'.$request->id,
                'company_logo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);
            
            if ($validator->fails()) {
                return response()->json(['status'=>false,'messages' => $validator->errors(), 'data'=>[] ]);
            }

            $res = CompanyProfile::where('id',$request->id)->select('company_logo')->first();
            $fileName = $res->company_logo;
            if($request->file('company_logo')) {
                $file_path = public_path().'/uploads/staff/'.$fileName;
                unlink($file_path);
                $fileName = time().'_'.$request->file('company_logo')->getClientOriginalName();
                $request->file('company_logo')->move('uploads/staff',$fileName);
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

            CompanyProfile::where('id',$request->id)->update([
                'company_name' => $request->company_name,
                'company_registered_business' => $request->company_registered_business,
                'zip_registered_address' => $request->zip_registered_address,
                'country_registered_address' => $request->country_registered_address,
                'state_registered_address' => $request->state_registered_address,
                'city_registered_address' => $request->city_registered_address,
                'company_correspondence_address' => $company_correspondence_address,
                'zip_correspondence_address' => $zip_correspondence_address,
                'country_correspondence_address' => $country_correspondence_address,
                'state_correspondence_address' => $state_correspondence_address,
                'city_correspondence_address' => $city_correspondence_address,
                'company_correspondence_email' => $request->company_correspondence_email,
                'company_correspondence_telephone' => $request->company_correspondence_telephone,
                'company_registration_number' => $request->company_registration_number,
                'tax_registration_number' => $request->tax_registration_number,
                'vat_number' => $request->vat_number,
                'company_logo' => $fileName,
            ]);
            return response()->json(['status'=>true,'messages' => 'Company profile successfully updated.', 'data'=>[] ]);
        } catch (Exception $e) {
            return response()->json(['status'=>false,'messages' => $e->getMessage(), 'data'=>[] ]);
        }
    }

    public function destroy($id){
        CompanyProfile::where('id',$id)->delete();
        return response()->json(['status'=>true,'messages' => 'Company profile successfully deleted.', 'data'=>[]]);   
    }
}
