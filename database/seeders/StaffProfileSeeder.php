<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\StaffRole;

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
        	array('name'=>'Accountable manage'),
        	array('name'=>'Head of training'),
        	array('name'=>'Chief Flight Instructor'),
        	array('name'=>'Chief Theoretical knowledge instructor'),
        	array('name'=>'Course supervisor'),
            array('name'=>'Instructor'),
            array('name'=>'Theoretical Knowledge instructor'),
            array('name'=>'Trainee'),
        	array('name'=>'Safety Manager'),
        	array('name'=>'Compliance manager'),
        );

        foreach ($array as $key => $value) {
        	StaffRole::create([
	            'role' => $value['name'],
                'is_edit' => 0,
        	]);	
        }
    }
}
