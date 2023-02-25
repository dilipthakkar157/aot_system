<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StaffProfile;

class StaffProfileController extends Controller
{
    public function index() {
    	return view('admin.staff_profile.list');
    }

    public function list() {
    	$result = StaffProfile::orderBy('id','DESC')->get();
    	return response()->json(['status'=>true,'messages' => 'Staff profile data.', 'data'=>$result]);
    }

    public function store(Request $request) {
        try {

            if($request->id>0){
                $validator = \Validator::make($request->all(), [
                    'id' => 'required|numeric',
                    'profile_name' => 'required|unique:staff_profile,name,'.$request->id
                ]);
            } else {
                $validator = \Validator::make($request->all(), [
                    'id' => 'required|numeric',
                    'profile_name' => 'required|unique:staff_profile,name'
                ]);    
            }

        	
            if ($validator->fails()) {
                return response()->json(['status'=>false,'messages' => $validator->errors(), 'data'=>[] ]);
            }
            $ins_arr = ['name'=>$request->profile_name,'is_edit'=>1];
            if($request->id == 0) {
                StaffProfile::create($ins_arr);
                $msg = 'Profile successfully added.';
            } else {
                StaffProfile::where('id',$request->id)->update(['name'=>$request->profile_name]);
                $msg = 'Profile successfully updated.';
            }
    		return response()->json(['status'=>true,'messages' => $msg, 'data'=>[] ]);
        } catch (Exception $e) {
            return response()->json(['status'=>false,'messages' => $e->getMessage(), 'data'=>[] ]);
        }
    }

    public function edit($id){
        $result = StaffProfile::where('id',$id)->first();
        return response()->json(['status'=>true,'messages' => 'Sinlge staff profile data.', 'data'=>$result]);
    }

    public function destroy($id){
        StaffProfile::where('id',$id)->delete();
        return response()->json(['status'=>true,'messages' => 'Staff profile successfully deleted.', 'data'=>[]]);   
    }
}
