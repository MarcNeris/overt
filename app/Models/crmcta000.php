<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class crmcta000 extends Model
{
 	use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function new_crmcta000($Request)
    {
        $crmcta000 = crmcta000::select('id')
                                ->where('idRegEnt',$Request['idRegEnt'])
                                ->where('idRegPsa',$Request['idRegPsa'])
                                ->where('idUsuReg',auth()->user()->id)
                                ->get();
        if(isset($crmcta000[0])){
            return $crmcta000[0]->id;
        }

        $crmcta000 = new crmcta000;
        $crmcta000['idUsuReg'] = auth()->user()->id;
        $crmcta000['idPrpReg'] = auth()->user()->id;
        $crmcta000['idUsuEdt'] = auth()->user()->id;
        $crmcta000['idRegEnt'] = $Request['idRegEnt'];
        $crmcta000['idRegEmp'] = $Request['idRegEmp'];
        $crmcta000['idRegPsa'] = $Request['idRegPsa'];
        $crmcta000['SitReg'] = 1;
        $crmcta000['SitCta'] = 1;
        $crmcta000['CapEmp'] = trataValor($Request['CapEmp']);
        $crmcta000['NatJur'] = $Request['NatJur'];
        $crmcta000['CodCne'] = $Request['CodCne'];
        $crmcta000->save();
    	return $crmcta000->id; 
    }
}
