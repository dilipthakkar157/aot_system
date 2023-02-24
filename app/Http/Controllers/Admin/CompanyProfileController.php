<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CompanyProfile;

class CompanyProfileController extends Controller
{
    public function index() {
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
    	return view('admin.company_profile.list',['company_profile' => $result]);
    }
}
