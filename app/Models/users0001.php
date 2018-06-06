<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\usersrole;
use App\Models\regemp000;
use App\User;

class users0001 extends Model
{
   
    public function User(){

    	return $this->belongsTo(User::class);
    }



    public function roles(){

        return $this->belongsTo(usersrole::class,'idRegRol');
    }



    public function regemp000(){

        return $this->belongsTo(regemp000::class,'idRegEmp');
    }

    

    public function new_users0001($Request)
    {
    	$users0001 = new users0001;
        //$users0001['id'] = abs(crc32(uniqid()));
        $users0001['user_id']  = isset($Request['user_id']) ? $Request['user_id'] : auth()->user()->id;
        $users0001['idPrpReg'] = auth()->user()->id;
        $users0001['idRegEnt'] = $Request['idRegEnt'];
        $users0001['idRegEmp'] = $Request['idRegEmp'];
        $users0001['idRegRol'] = isset($Request['CodRol']) ? $Request['CodRol'] : 1;
        $users0001['SitReg']   = 1;
        $users0001['SitUsu']   = 1;//isset($Request['user_id']) ? 0 : 1;
        $users0001['EmlUsu']   = strtolower(isset($Request['EmlUsu']) ? $Request['EmlUsu'] : auth()->user()->email);
        $users0001->save();
        return $users0001->id;
    }
}
