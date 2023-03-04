<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StaffRole extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table='staff_role';
    protected $fillable = ['role','is_edit'];
}
