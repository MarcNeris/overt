<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class logeml001 extends Model
{
    public function new_logeml001($Request)
    {

    	$logeml001 = new logeml001;
		$logeml001['idPrpReg'] = auth()->user()->id;
		$logeml001['NomDst'] = $Request['NomDst'];
		$logeml001['EmlDst'] = $Request['EmlDst'];
		$logeml001['NomEmt'] = $Request['NomEmt'];
		$logeml001['EmlEmt'] = $Request['EmlEmt'];
		$logeml001['EmlTit'] = $Request['EmlTit'];
		$logeml001['EmlDsc'] = $Request['EmlDsc'];
		$logeml001['EmlFin'] = $Request['EmlFin'];
		$logeml001['NomFta'] = $Request['NomFta'];
		$logeml001['SitEml'] = 0;
		$logeml001->save();
		return $logeml001->id;
    }
}
