<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class regempusu extends Model
{

    public function user(){

    	return $this->belongsTo(User::class);
    }

    public function new_regempusu($Request){
  
    	$regempusu = new regempusu;
        $regempusu['user_id'] 	= isset($Request['user_id'])?$Request['user_id']:auth()->user()->id;
        $regempusu['idPrpEnt']  = auth()->user()->id;
        $regempusu['idRegEnt'] 	= $Request['idRegEnt'];
        $regempusu['idRegEmp'] 	= $Request['idRegEmp'];
        $regempusu['SitReg'] 	= 1;
        $regempusu['SitUsu']    = 1;
        $regempusu->save();
        return $regempusu->id;
    }

}
