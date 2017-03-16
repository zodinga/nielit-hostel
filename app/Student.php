<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function course(){
    	return $this->belongsTo('App\Course');
    }

    public function hosteller_1(){
    	return $this->hasOne('App\hmsModel\Hosteller');
    }

    public function hosteller_2(){
    	return $this->hasOne('App\hmsModel\Hosteller');
    }
}
