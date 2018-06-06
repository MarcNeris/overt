<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class regcto000 extends Model
{	
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

	public function new_regcto000($Request)
    {
    	$regcto000 = regcto000::select('id')
    							->where('NomCto',$Request['NomCto'])
                                ->where('idRegEnt',$Request['idRegEnt'])
                                ->where('idRegEmp',$Request['idRegEmp'])
                                ->where('idUsuReg',auth()->user()->id)
                                ->get();
        if(isset($regcto000[0])){
            return $regcto000[0]->id;
        }

	    $regcto000 = new regcto000;
	    $regcto000['idUsuReg'] = auth()->user()->id;
	    $regcto000['idPrpReg'] = auth()->user()->id;
	    $regcto000['idUsuEdt'] = auth()->user()->id;
	    $regcto000['idRegEnt'] = $Request['idRegEnt'];
	    $regcto000['idRegEmp'] = $Request['idRegEmp'];
	    $regcto000['SitReg'] = 1;
	    $regcto000['SitCto'] = 1;
	    $regcto000['TipCto'] = $Request['TipCto'];
	    $regcto000['NomCto'] = $Request['NomCto'];
	    $regcto000['CodCrg'] = $Request['CodCrg'];
	    $regcto000['NomCrg'] = $Request['NomCrg'];
	    $regcto000['TelCto'] = $Request['TelCto'];
	    $regcto000['EmlCto'] = $Request['EmlCto'];
	    $regcto000->save();
	    return $regcto000->id;
	}
}
