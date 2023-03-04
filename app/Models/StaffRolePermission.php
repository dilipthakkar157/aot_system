<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffRolePermission extends Model
{
    use HasFactory;
    protected $table='staff_role_permission';
    protected $fillable = ['staff_role_id','permission','staff_action_ids'];
}
