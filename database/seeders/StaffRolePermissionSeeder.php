<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\StaffRolePermission;

class StaffRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = array(
        	array('staff_role_id'=>10,'permission'=>1,'staff_action_ids'=>json_encode(array('1'))),
        	array('staff_role_id'=>10,'permission'=>2,'staff_action_ids'=>json_encode(array('1'))),
        	array('staff_role_id'=>10,'permission'=>3,'staff_action_ids'=>json_encode(array('23'))),
        	array('staff_role_id'=>10,'permission'=>4,'staff_action_ids'=>json_encode(array('24'))),
        );

        foreach ($array as $key => $value) {
        	StaffRolePermission::create([
	            'staff_role_id' => $value['staff_role_id'],
	            'permission' => $value['permission'],
	            'staff_action_ids' => $value['staff_action_ids'],
        	]);	
        }
    }
}
