<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffAction extends Model
{
    use HasFactory;
    protected $table='staff_action_modules';
    protected $fillable = ['action'];
}
