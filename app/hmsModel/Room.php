<?php

namespace App\HmsModel;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public function hosteller_1(){
    	return $this->hasOne('App\hmsModel\Hosteller','id','hosteller_1_id');
    }

    public function hosteller_2(){
    	return $this->hasOne('App\hmsModel\Hosteller','id','hosteller_2_id');
    }
}
