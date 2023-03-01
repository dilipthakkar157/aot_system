<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompanyDashboardController extends Controller
{
    public function index(){
    	return view('company_profile.dashboard');
    }
}
