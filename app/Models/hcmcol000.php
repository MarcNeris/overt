<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Session;

class hcmcol000 extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public static function new_hcmcol000($Request)
    {


    	$id = hcmcol000::select('id')
			->where('idRegEmp', 1)//Session::get('idRegEmp'))
			->where('NumCgc', $Request['NumCgc'])
			->where('NumCpf', $Request['NumCpf'])
			->first();

		if($id){
			$hcmcol000 = hcmcol000::find($id->id);
		} else{
			$hcmcol000 = new hcmcol000;
		}

	    $hcmcol000->idUsuReg = 1;//auth()->user()->id;
        $hcmcol000->idPrpReg = 1;//auth()->user()->id;
        $hcmcol000->idUsuEdt = 1;//auth()->user()->id;
        $hcmcol000->idRegEnt = 1;//Session::get('idRegEnt');
        $hcmcol000->idRegEmp = 1;//Session::get('idRegEmp');
        $hcmcol000->SitReg = 1;
        $hcmcol000->SitAfa = $Request['SitAfa'];
        $hcmcol000->DatAdm = Carbon::createFromFormat('Y-m-d', $Request['DatAdm'])->format('Y-m-d');
        $hcmcol000->DatNas = Carbon::createFromFormat('Y-m-d', $Request['DatNas'])->format('Y-m-d');
        $hcmcol000->NomFun = $Request['NomFun'];
        $hcmcol000->NumCad = $Request['NumCad'];
        $hcmcol000->NumCgc = $Request['NumCgc'];
        $hcmcol000->NumCpf = $Request['NumCpf'];
        $hcmcol000->NumCra = $Request['NumCra'];
        $hcmcol000->NumCtp = $Request['NumCtp'];
        $hcmcol000->NumEmp = $Request['NumEmp'];
        $hcmcol000->NumEmp = $Request['NumEmp'];
        $hcmcol000->NumPis = $Request['NumPis'];
        $hcmcol000->NomUsu = 'Sync';
        $hcmcol000->EmlUsu = 'Sync';
        $hcmcol000->EmlVrf = 'Sync';
        $hcmcol000->UsuUid = 'Sync';
        $hcmcol000->save();
        
    	return $hcmcol000->id;
    }
}
