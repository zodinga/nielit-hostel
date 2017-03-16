<?php

namespace App\hmsModel;

use Illuminate\Database\Eloquent\Model;

class admitFee extends Model
{
    public function hosteller(){
    	return $this->hasOne('App\hmsModel\Hosteller','id','hosteller_id');
    }
}
