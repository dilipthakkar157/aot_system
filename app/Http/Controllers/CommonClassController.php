<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Countries;
use App\Models\States;
use App\Models\Cities;

class CommonClassController extends Controller
{
    public function getCounties(){
    	$result = Countries::get();
        return response()->json(['status'=>true,'messages' => 'Countries data.', 'data'=>$result]);
    }

    public function getStates($country_id){
    	$result = States::where('country_id',$country_id)->get();
        return response()->json(['status'=>true,'messages' => 'States data.', 'data'=>$result]);	
    }

    public function getCities($state_id){
    	$result = Cities::where('state_id',$state_id)->get();
        return response()->json(['status'=>true,'messages' => 'Cities data.', 'data'=>$result]);
    }
}
