<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use DataTables;

class CustomerController extends Controller
{
    public function index(){
        return view('company_profile.customer_list');
    }

    public function list() {
		$company_id = \Auth::guard('company_profile')->user()->id;
    	$result = Customer::where('company_id',$company_id)->orderBy('id','DESC')->get();
        if(count($result)>0){
            foreach ($result as $key => $customer_profile) {
                $rep_dob = str_replace("-",'/',$customer_profile->date_of_birth);
	            $dob = date('d/m/Y', strtotime($rep_dob));
                $result[$key]['date_of_birth'] = $dob;
            }
        }

        return Datatables::of($result)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
   
                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editCustomer"><i class="fa fa-pencil"></i></a>';
   
                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteCustomer"><i class="fa fa-trash"></i></a>';
    
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
                    'first_name' => 'required',
                    'middle_name' => 'required',
                    'last_name' => 'required',
                    'date_of_birth' => 'required',
                    'place_of_birth' => 'required',
                    'social_security_number' => 'required|unique:customers,social_security_number,'.$request->id,
                    'email' => 'required|unique:customers,email,'.$request->id,
                    'photo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                ]);
            } else {
                $validator = \Validator::make($request->all(), [
                    'first_name' => 'required',
                    'middle_name' => 'required',
                    'last_name' => 'required',
                    'date_of_birth' => 'required',
                    'place_of_birth' => 'required',
                    'social_security_number' => 'required|unique:customers,social_security_number',
                    'email' => 'required|unique:customers,email',
                    'photo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                ]);
            }
            if ($validator->fails()) {
                return response()->json(['status'=>false,'messages' => $validator->errors(), 'data'=>[] ]);
            }

            $company_id = \Auth::guard('company_profile')->user()->id;

            $trim_fname = preg_replace('/\s+/', '', $request->first_name);
            $trim_mname = preg_replace('/\s+/', '', $request->middle_name);
            $trim_lname = preg_replace('/\s+/', '', $request->last_name);

            $combine_name = $trim_fname."".$trim_mname."".$trim_lname;
            $three_latter_code = $this->generateTokenNew($combine_name);

            $rep_dob = str_replace("/",'-',$request->date_of_birth);
	        $dob = date('Y-m-d', strtotime($rep_dob));
            
            $fileName = '';
            if($request->id>0){
                $res = Customer::where(['company_id'=>$company_id,'id'=>$request->id])->first();
                $fileName = $res->photo;
            }

            if($request->file('photo')) {
                if($fileName!=null) {
                    $file_path = public_path().'/uploads/customers/'.$fileName;
                    unlink($file_path);
                }
                $fileName = time().'_'.$request->file('photo')->getClientOriginalName();
                $request->file('photo')->move('uploads/customers',$fileName);
            }

            $Customer = Customer::updateOrCreate(array('id' => $request->id));
            $Customer->company_id = $company_id;
            $Customer->first_name = $request->first_name;
            $Customer->middle_name = $request->middle_name;
            $Customer->last_name = $request->last_name;
            $Customer->date_of_birth = $dob;
            $Customer->place_of_birth = $request->place_of_birth;
            $Customer->social_security_number = $request->social_security_number;
            $Customer->email = $request->email;
            $Customer->photo = $fileName;
            if($request->id==0){
                $Customer->three_letter_code = strtoupper($three_latter_code);
            }
            $Customer->save();

            if($request->id>0){
                $msg = 'Customer profile successfully updated.';
            } else {
                $msg = 'Customer profile successfully added.';
            }
            return response()->json(['status'=>true,'messages' => $msg, 'data'=>[] ]);

        } catch (Exception $e) {
            return response()->json(['status'=>false,'messages' => $e->getMessage(), 'data'=>[] ]);
        }
    }

    public function generateTokenNew($combine_name){
        $three_latter_code = generateToken($combine_name,3);
        $res = Customer::where('three_letter_code',$three_latter_code)->count();
        if($res>0){
            $this->generateTokenNew($combine_name);
        } else {
            return $three_latter_code;
        }
    }

    public function edit($id){
        $company_id = \Auth::guard('company_profile')->user()->id;
    	$res = Customer::where(['company_id'=>$company_id,'id'=>$id])->first();
    	$rep_dob = str_replace("-",'/',$res->date_of_birth);
	    $dob = date('d/m/Y', strtotime($rep_dob));
	    $res->date_of_birth = $dob;
    	return response()->json(['status'=>true,'messages' => 'Single customer profile.', 'data'=>$res ]);
    }

    public function destroy($id){
        $company_id = \Auth::guard('company_profile')->user()->id;
    	Customer::where(['company_id'=>$company_id,'id'=>$id])->delete();
        return response()->json(['status'=>true,'messages' => 'Customer profile successfully deleted.', 'data'=>[]]);
    }
}
