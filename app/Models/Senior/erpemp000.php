<?php

namespace App\Models\Senior;

use Illuminate\Database\Eloquent\Model;

class erpemp000 extends Model
{
    public function new_erpemp000($Request)
    {
    	$erpemp000 = new erpemp000;
    	$erpemp000['id'] =  auth()->user()->id.$Request['CodEmp'].$Request['CodFil'];
    	$erpemp000['user_id'] = auth()->user()->id;
    	$erpemp000['CodEmp'] = $Request['CodEmp'];
    	$erpemp000['CodFil'] = $Request['CodFil'];
    	$erpemp000['SitEmp'] = 1;
    	$erpemp000['NomSis'] = $Request['NomSis'];
    	$erpemp000['SigEmp'] = $Request['SigEmp'];
    	$erpemp000['SigFil'] = $Request['SigFil'];
        $erpemp000->save();
        return $erpemp000->id;
    }
}
