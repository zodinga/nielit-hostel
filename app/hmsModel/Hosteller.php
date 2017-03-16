<?php

namespace App\hmsModel;

use Illuminate\Database\Eloquent\Model;

class Hosteller extends Model
{
    public function student_1(){
    	return $this->belongsTo('App\Student','hosteller_1_id');
    }

    public function student_2(){
    	return $this->belongsTo('App\Student','hosteller_2_id');
    }

    public function course(){
        return $this->belongsTo('App\Course');
    }

    public function bed_1(){
    	return $this->belongsTo('App\hmsModel\Room','id','hosteller_1_id');
    }

    public function bed_2(){
    	return $this->belongsTo('App\hmsModel\Room','id','hosteller_2_id');
    }

    public function admitFee(){
        return $this->belongsTo('App\hmsModel\admitFee','id','hosteller_id');
    }

    public function roomRent(){
        return $this->belongsTo('App\hmsModel\roomRent','id','hosteller_id');
    }

    public function messFee(){
        return $this->belongsTo('App\hmsModel\messFee','id','hosteller_id');
    }
}
