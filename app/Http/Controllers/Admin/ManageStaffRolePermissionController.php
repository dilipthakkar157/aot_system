<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StaffRole;
use DataTables;

class ManageStaffRolePermissionController extends Controller
{
    public function index() {
    	return view('admin.staff_profile.listnew');
    }

    public function list() {
    	$result = StaffRole::orderBy('id','DESC')->get();
        $final_result = array();
        if(count($result)>0){
            foreach ($result as $key => $staff_profile) {
                $final_result[$key]['id'] = $staff_profile->id;
                $final_result[$key]['role'] = $staff_profile->role;
            }
        }

        return Datatables::of($final_result)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
   
                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row['id'].'" data-original-title="Edit" class="edit btn btn-primary btn-sm editStaffProfile"><i class="fa fa-pencil"></i></a>';
   
                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row['id'].'" data-original-title="Delete" class="btn btn-danger btn-sm deleteStaffProfile"><i class="fa fa-trash"></i></a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
    	// return response()->json(['status'=>true,'messages' => 'Staff profile data.', 'data'=>$result]);
    }

    public function store(Request $request) {
        try {

            if($request->id>0){
                $validator = \Validator::make($request->all(), [
                    'id' => 'required|numeric',
                    'role' => 'required|unique:staff_role,role,'.$request->id
                ]);
            } else {
                $validator = \Validator::make($request->all(), [
                    'role' => 'required|unique:staff_rolee,role'
                ]);    
            }

        	
            if ($validator->fails()) {
                return response()->json(['status'=>false,'messages' => $validator->errors(), 'data'=>[] ]);
            }
            $ins_arr = ['role'=>$request->role,'is_edit'=>1];
            if($request->id == 0) {
                StaffRole::create($ins_arr);
                $msg = 'Profile successfully added.';
            } else {
                StaffRole::where('id',$request->id)->update(['role'=>$request->role]);
                $msg = 'Profile successfully updated.';
            }
    		return response()->json(['status'=>true,'messages' => $msg, 'data'=>[] ]);
        } catch (Exception $e) {
            return response()->json(['status'=>false,'messages' => $e->getMessage(), 'data'=>[] ]);
        }
    }

    public function edit($id){
        $result = StaffRole::where('id',$id)->first();
        return response()->json(['status'=>true,'messages' => 'Sinlge staff profile data.', 'data'=>$result]);
    }

    public function destroy($id){
        StaffRole::where('id',$id)->delete();
        return response()->json(['status'=>true,'messages' => 'Staff profile successfully deleted.', 'data'=>[]]);   
    }
}