<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\StaffAction;

class StaffActionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = array(
        	array('name'=>'All'),
        	array('name'=>'Training programs'),
        	array('name'=>'Staff members'),
        	array('name'=>'Trainees'),
        	array('name'=>'Chief Flight Instructor Events'),
            array('name'=>'ACFT, FSTD and TKI part of all courses'),
            array('name'=>'All Instructors'),
            array('name'=>'Chief Theoretical knowledge instructor events'),
            array('name'=>'TKI part of all courses'),
        	array('name'=>'TKI Training programs'),
        	array('name'=>'Theoretical instructors'),
        	array('name'=>'All TKI Instructors'),
        	array('name'=>'Instructors'),
        	array('name'=>'Course supervisor events'),
        	array('name'=>'courses where he is supervisor'),
        	array('name'=>'ACFT, FSTD, TKI trainings'),
        	array('name'=>'Instructor events'),
        	array('name'=>'TKI traning'),
        	array('name'=>'TKI events'),
        	array('name'=>'Trainee events'),
        	array('name'=>'Only Safety management events'),
        	array('name'=>'Safety management only'),
        	array('name'=>'Only Compliance management events'),
        	array('name'=>'Compliance management only'),
        	array('name'=>'None'),
        );

        foreach ($array as $key => $value) {
        	StaffAction::create([
	            'action' => $value['name']
        	]);	
        }
    }
}
