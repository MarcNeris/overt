<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Session;

class regcli000 extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function new_regcli000($Request){

		$regcli000 = crmcta000::select('id')
		                        ->where('idRegEnt',Session::get('idRegEnt'))
		                        ->where('idRegPsa',$Request['idRegPsa'])
		                        ->where('idUsuReg',auth()->user()->id)
		                        ->get();
		if(isset($regcli000[0])){
		    return $regcli000[0]->id;
		}

		$regcli000 = new regcli000;
		$regcli000['idUsuReg'] = auth()->user()->id;
		$regcli000['idPrpReg'] = auth()->user()->id;
		$regcli000['idUsuEdt'] = auth()->user()->id;
		$regcli000['idRegEnt'] = Session::get('idRegEnt');
		$regcli000['idRegEmp'] = Session::get('idRegEmp');
		$regcli000['idRegPsa'] = $Request['idRegPsa'];
		$regcli000['SitReg'] = $Request['SitReg'];
		$regcli000['SitCli'] = $Request['SitCli'];
		$regcli000['CapEmp'] = $Request['CapEmp'];
		$regcli000['NatJur'] = $Request['NatJur'];
		$regcli000['CodCne'] = $Request['CodCne'];
		$regcli000['CodErp'] = $Request['CodErp'];
		$regcli000->save();
		return $regcli000->id;
    }
}
