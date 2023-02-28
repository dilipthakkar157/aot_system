<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CompanyProfile;
use DataTables;

class CompanyProfileController extends Controller
{
    public function index() {
    	return view('admin.company_profile.listnew');
    }

    public function list() {
        $final_result = array();
        $result = CompanyProfile::with('registered_country','registered_state','registered_city','correspondence_country','correspondence_state','correspondence_city')->orderBy('id','DESC')->get();
        if(count($result)>0){
            foreach ($result as $key => $company_profile) {
                
                $final_result[$key]['id'] = $company_profile->id;
                $final_result[$key]['company_name'] = $company_profile->company_name;
                $final_result[$key]['company_registered_business'] = $company_profile->company_registered_business;
                $final_result[$key]['zip_registered_address'] = $company_profile->zip_registered_address;
                $final_result[$key]['country_registered_address'] = (isset($company_profile->registered_country)) ? $company_profile->registered_country->name : '-';
                $final_result[$key]['state_registered_address'] = (isset($company_profile->registered_state)) ? $company_profile->registered_state->name : '-';
                $final_result[$key]['city_registered_address'] = (isset($company_profile->registered_city)) ? $company_profile->registered_city->name : '-';

                $final_result[$key]['company_correspondence_address'] = $company_profile->company_correspondence_address;
                $final_result[$key]['zip_correspondence_address'] = $company_profile->zip_correspondence_address;
                $final_result[$key]['country_correspondence_address'] = (isset($company_profile->correspondence_country)) ? $company_profile->correspondence_country->name : '-';
                $final_result[$key]['state_correspondence_address'] = (isset($company_profile->correspondence_state)) ? $company_profile->correspondence_state->name : '-';
                $final_result[$key]['city_correspondence_address'] = (isset($company_profile->correspondence_city)) ? $company_profile->correspondence_city->name : '-';

                $final_result[$key]['company_correspondence_email'] = $company_profile->company_correspondence_email;
                $final_result[$key]['company_correspondence_telephone'] = $company_profile->company_correspondence_telephone;
                $final_result[$key]['company_registration_number'] = $company_profile->company_registration_number;
                $final_result[$key]['tax_registration_number'] = $company_profile->tax_registration_number;
            }
        }

        return Datatables::of($final_result)
                    // ->addIndexColumn()
                    ->addColumn('action', function($row){
   
                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row['id'].'" data-original-title="Edit" class="edit btn btn-primary btn-sm editCompanyProfile"><i class="fa fa-pencil"></i></a>';
   
                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row['id'].'" data-original-title="Delete" class="btn btn-danger btn-sm deleteCompanyProfile"><i class="fa fa-trash"></i></a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);

        // return response()->json(['status'=>true,'messages' => 'Company profile data.', 'data'=>$result]);
    }

    public function edit($id) {
        $result = CompanyProfile::where('id',$id)->first();
        return response()->json(['status'=>true,'messages' => 'Sinlge company profile data.', 'data'=>$result]);
    }

    public function update(Request $request) {
        try {

            if($request->id>0) {
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

            } else {
                $validator = \Validator::make($request->all(), [
                    'company_name' => 'required|unique:company_profile,company_name',
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
                    'company_correspondence_email' => 'required|email|unique:company_profile,company_correspondence_email',
                    'company_correspondence_telephone' => 'required|unique:company_profile,company_correspondence_telephone',
                    'company_registration_number' => 'required|unique:company_profile,company_registration_number',
                    'tax_registration_number' => 'required|unique:company_profile,tax_registration_number',
                    'vat_number' => 'required|unique:company_profile,vat_number',
                    'company_logo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                ]);
            }
            
            if ($validator->fails()) {
                return response()->json(['status'=>false,'messages' => $validator->errors(), 'data'=>[] ]);
            }
            $fileName = null;
            if($request->id>0){
                $res = CompanyProfile::where('id',$request->id)->select('company_logo')->first();
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

            $CompanyProfile = CompanyProfile::updateOrCreate(array('id' => $request->id));

            // CompanyProfile::where('id',$request->id)->update([
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
            // ]);
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
