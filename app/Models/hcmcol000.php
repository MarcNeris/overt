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
			->where('idRegEmp', Session::get('idRegEmp'))
			->where('NumCgc', $Request['NumCgc'])
			->where('NumCpf', $Request['NumCpf'])
			->first();

		if($id){
			$hcmcol000 = hcmcol000::find($id->id);
		} else{
			$hcmcol000 = new hcmcol000;
		}

	    $hcmcol000->idUsuReg = auth()->user()->id;
        $hcmcol000->idPrpReg = auth()->user()->id;
        $hcmcol000->idUsuEdt = auth()->user()->id;
        $hcmcol000->idRegEnt = Session::get('idRegEnt');
        $hcmcol000->idRegEmp = Session::get('idRegEmp');
        $hcmcol000->SitReg = 1;
        $hcmcol000->SitAfa = $Request['SitAfa'];
        $hcmcol000->DatAdm = $Request['DatAdm'];
        $hcmcol000->DatNas = $Request['DatNas'];
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

        // $hcmcol000['idUsuReg'] = auth()->user()->id;
        // $hcmcol000['idPrpReg'] = auth()->user()->id;
        // $hcmcol000['idUsuEdt'] = auth()->user()->id;
        // $hcmcol000['idRegEnt'] = Session::get('idRegEnt');
        // $hcmcol000['idRegEmp'] = Session::get('idRegEmp');
        // $hcmcol000['SitReg'] = 1;
        // $hcmcol000['SitAfa'] = $Request['SitAfa'];
        // $hcmcol000['DatAdm'] = $Request['DatAdm'];
        // $hcmcol000['DatNas'] = $Request['DatNas'];
        // $hcmcol000['NomFun'] = $Request['NomFun'];
        // $hcmcol000['NumCad'] = $Request['NumCad'];
        // $hcmcol000['NumCgc'] = $Request['NumCgc'];
        // $hcmcol000['NumCpf'] = $Request['NumCpf'];
        // $hcmcol000['NumCra'] = $Request['NumCra'];
        // $hcmcol000['NumCtp'] = $Request['NumCtp'];
        // $hcmcol000['NumEmp'] = $Request['NumEmp'];
        // $hcmcol000['NumEmp'] = $Request['NumEmp'];
        // $hcmcol000['NumPis'] = $Request['NumPis'];
        // $hcmcol000['NomUsu'] = 'Sync';
        // $hcmcol000['EmlUsu'] = 'Sync';
        // $hcmcol000['EmlVrf'] = 'Sync';
        // $hcmcol000['UsuUid'] = 'Sync';
