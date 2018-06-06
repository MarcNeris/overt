<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class users0002 extends Model
{
	public function new_users0002($Request)
    {
		$this->idRegRol = 1;
    	$this->idRegTsk = $Request['idRegTsk'];
    	$this->SitTsk = $Request['SitTsk'];
    	$this->save();
    	return $this->id;
	}
}
