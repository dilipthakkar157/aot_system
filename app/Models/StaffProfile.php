<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class StaffProfile extends Authenticatable
{
    use HasFactory;
    protected $guard = 'staff_profile';
    use SoftDeletes;
    protected $table='staff_profile';
    protected $fillable = ['id'];

    public function staffrole(){
    	return $this->belongsTo(StaffRole::class,'role');
    }
}
