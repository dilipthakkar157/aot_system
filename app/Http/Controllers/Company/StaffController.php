<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StaffProfile;
use App\Models\CompanyProfile;
use DataTables;

class StaffController extends Controller
{
    public function index() {
		return view('company_profile.staff_list');
	}

	public function list() {
		$company_id = \Auth::guard('company_profile')->user()->id;
    	$result = StaffProfile::where('company_id',$company_id)->with('staffrole')->orderBy('id','DESC')->get();
        if(count($result)>0){
            foreach ($result as $key => $staff_profile) {
                $result[$key]['role'] = $staff_profile->staffrole->role;
            }
        }

        return Datatables::of($result)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
   
                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editStaff"><i class="fa fa-pencil"></i></a>';
   
                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteStaff"><i class="fa fa-trash"></i></a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
    }

    public function store(Request $request){
    	try {
            if($request->id>0){
                $validator = \Validator::make($request->all(), [
                    'id' => 'required|numeric',
                    'three_letter_code' => 'required|unique:staff_profile,three_letter_code,'.$request->id,
                    'prefix' => 'required',
                    'name' => 'required',
                    // 'middle_name' => 'required',
                    'last_name' => 'required',
                    'email' => 'required|email|unique:staff_profile,email,'.$request->id,
                    'citizenship' => 'required',
                    'date_of_birth' => 'required',
                    // 'passport_id' => 'unique:staff_profile,passport_id,'.$request->id,
                    'role' => 'required',
                ]);
            } else {
                $validator = \Validator::make($request->all(), [
                    'three_letter_code' => 'required|unique:staff_profile,three_letter_code',
                    'prefix' => 'required',
                    'name' => 'required',
                    // 'middle_name' => 'required',
                    'last_name' => 'required',
                    'email' => 'required|email|unique:staff_profile,email',
                    'citizenship' => 'required',
                    'date_of_birth' => 'required',
                    // 'passport_id' => 'unique:staff_profile,passport_id',
                    'role' => 'required',
                ]);
            }
            if ($validator->fails()) {
                return response()->json(['status'=>false,'messages' => $validator->errors(), 'data'=>[] ]);
            }

            $company_id = \Auth::guard('company_profile')->user()->id;

            /*if($request->id>0){
            	$check_tlc = StaffProfile::where('id','!=',$request->id)->where(['company_id'=>$company_id,'three_letter_code'=>$request->three_letter_code])->count();
	        } else {
	        	$check_tlc = StaffProfile::where(['company_id'=>$company_id,'three_letter_code'=>$request->three_letter_code])->count();
	        }
	        if($check_tlc>0){
	        	$error['three_letter_code'][0] = 'Duplicate three letter code for staff.';
	        	return response()->json(['status'=>false,'messages' => $error, 'data'=>[] ]);	
	        }*/

	        if(strlen($request->three_letter_code)>3){
	        	$error['three_letter_code'][0] = 'Only three letter code allowed.';
	        	return response()->json(['status'=>false,'messages' => $error, 'data'=>[] ]);	
	        }

	        $employee_no = 0;
	        $get_last_record = StaffProfile::where('company_id',$company_id)->latest()->first();
	        if(!empty($get_last_record)){
	        	$employee_no = $get_last_record->employee_no;
	        }

	        $rep_dob = str_replace("/",'-',$request->date_of_birth);
	        $dob = date('Y-m-d', strtotime($rep_dob));

	        $emp = $employee_no + 1;
            $StaffProfile = StaffProfile::updateOrCreate(array('id' => $request->id));
            $StaffProfile->company_id = $company_id;
            $StaffProfile->three_letter_code = $request->three_letter_code; 
            if($request->id==0){
            	$StaffProfile->employee_no = $emp;
	        }
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

    public function edit($id){
    	$res = StaffProfile::where('id',$id)->first();
    	$rep_dob = str_replace("-",'/',$res->date_of_birth);
	    $dob = date('d/m/Y', strtotime($rep_dob));
	    $res->date_of_birth = $dob;
    	return response()->json(['status'=>true,'messages' => 'Single Staff profile.', 'data'=>$res ]);
    }

    public function destroy($id){
    	StaffProfile::where('id',$id)->delete();
        return response()->json(['status'=>true,'messages' => 'Staff profile successfully deleted.', 'data'=>[]]);
    }

    // public function resetPassword(Request $request) {
    //     $res = StaffProfile::where('reset_token',$request->token)->first();
    //     if(!empty(($res))){
    //         $time = $res->reset_token_date_time;
    //         $new_time = $my_date_time = date('Y-m-d H:i:s', strtotime($time.' +1 hour'));
    //         $current_time = date('Y-m-d H:i:s');
    //         if(strtotime($current_time) > strtotime($new_time)) {
    //             return redirect()->route('common.login')->with('error_msg','Token is expired!');    
    //         }
    //         return view('staff_profile.reset_password',['token'=>$request->token]);
    //     } else {
    //         return redirect()->route('common.login')->with('error_msg','Invalid token!');
    //     }
    // }

    // public function updatePassword(Request $request) {
    //     $this->validate($request, [
    //         'token' => 'required',
    //         'new_password' => 'required|required_with:confirm_new_password|same:confirm_new_password',
    //         'confirm_new_password' => 'required'
    //     ]);

    //     $res = StaffProfile::where('reset_token',$request->token)->first();
    //     if(!empty(($res))){
    //         StaffProfile::where('id',$res->id)->update(['password'=>\Hash::make($request->new_password),'reset_token'=>null]);
    //         return redirect()->route('common.login')->with('success_msg','Password Successfully reset.');
    //     } else {
    //         return redirect()->route('common.login')->with('error_msg','Invalid token!');
    //     }
    // }
}
