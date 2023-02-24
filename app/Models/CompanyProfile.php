<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyProfile extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table='company_profile';

    public function registered_country(){
    	return $this->belongsTo(Countries::class,'country_registered_address');
    }

    public function registered_state(){
    	return $this->belongsTo(States::class,'state_registered_address');
    }

    public function registered_city(){
    	return $this->belongsTo(Cities::class,'city_registered_address');
    }

    public function correspondence_country(){
    	return $this->belongsTo(Countries::class,'country_correspondence_address');
    }

    public function correspondence_state(){
    	return $this->belongsTo(States::class,'state_correspondence_address');
    }

    public function correspondence_city(){
    	return $this->belongsTo(Cities::class,'city_correspondence_address');
    }
}
