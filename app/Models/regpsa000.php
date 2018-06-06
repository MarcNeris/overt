<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class regpsa000 extends Model
{
	use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function new_regpsa000($Request)
    {   

        $regpsa000 = regpsa000::select('id')
                                ->where('RegFed',soNumero($Request['RegFed']))
                                ->where('idUsuReg',auth()->user()->id)
                                ->get();
        if(isset($regpsa000[0])){
            return $regpsa000[0]->id;
        }

        $regpsa000 = new regpsa000;
        $regpsa000['idUsuReg'] = auth()->user()->id;
        $regpsa000['idPrpReg'] = auth()->user()->id;
        $regpsa000['idUsuEdt'] = auth()->user()->id;
        $regpsa000['idRegEnt'] = $Request['idRegEnt'];
        //$regpsa000['idRegEmp'] = $Request['idRegEmp'];
        $regpsa000['SitReg']   = 1;
        $regpsa000['SitPsa']   = 1;
        $regpsa000['RegFed']   = soNumero($Request['RegFed']);
        $regpsa000['NomPsa']   = $Request['NomPsa'];
        $regpsa000['NomFta']   = $Request['NomFta'];
        $regpsa000['DatReg']   = Carbon::createFromFormat('d/m/Y', $Request['DatReg'])->format('Y-m-d');
        $regpsa000['CodMun']   = $Request['CodMun'];
        $regpsa000->save();
        return $regpsa000->id;
    }
}
