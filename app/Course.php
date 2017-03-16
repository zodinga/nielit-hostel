<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function students(){
    	$this->hasMany('App\Student');
    } 

    public function hostellers(){
    	$this->hasMany('App\hmsModel\Hosteller');
    }
}
