<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\StaffProfile;

class StaffProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = array(
        	array('name'=>'Accountable manager','is_edit'=>0),
        	array('name'=>'Head of training','is_edit'=>0),
        	array('name'=>'Chief flight Instructor','is_edit'=>0),
        	array('name'=>'Chief Theoretical knowledge instructor','is_edit'=>0),
        	array('name'=>'Course supervisor','is_edit'=>0),
        	array('name'=>'Safety manager','is_edit'=>0),
        	array('name'=>'Compliance manager','is_edit'=>0),
        );

        foreach ($array as $key => $value) {
        	StaffProfile::create([
	            'name' => $value['name'],
	            'is_edit' => $value['is_edit'],
        	]);	
        }
    }
}
