<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class regend000 extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function new_regend000($Request)
    {	
    	 $regend000 = regend000::select('id')
                                ->where('idRegEnt',$Request['idRegEnt'])
                                ->where('idRegPsa',$Request['idRegPsa'])
                                ->where('idUsuReg',auth()->user()->id)
                                ->get();
        if(isset($regend000[0])){
            return $regend000[0]->id;
        }

    	$regend000 = new regend000;
        $regend000['idUsuReg'] = auth()->user()->id;
        $regend000['idPrpReg'] = auth()->user()->id;
        $regend000['idUsuEdt'] = auth()->user()->id;
        $regend000['idRegEnt'] = $Request['idRegEnt'];
        $regend000['idRegEmp'] = $Request['idRegEmp'];
        $regend000['idRegPsa'] = $Request['idRegPsa'];
        $regend000['SitReg'] = 1;
        $regend000['SitEnd'] = 1;
        $regend000['TipEnd'] = 1;
        $regend000['CepEnd'] = soNumero($Request['CepEnd']);
        $regend000['NomEnd'] = $Request['NomEnd'];
        $regend000['NumEnd'] = $Request['NumEnd'];
        $regend000['CplEnd'] = $Request['CplEnd'];
        $regend000['BroEnd'] = $Request['BroEnd'];
        $regend000['CodMun'] = $Request['CodMun'];
        $regend000->save();
        return $regend000->id;
    }
}
