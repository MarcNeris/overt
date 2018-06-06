<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class regemp000 extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];


    public function new_regemp000($Request)
    {
        $regemp000 = regemp000::select('id')
                                ->where('idRegEnt',$Request['idRegEnt'])
                                ->where('idRegPsa',$Request['idRegPsa'])
                                ->where('idUsuReg',auth()->user()->id)
                                ->get();
                                
        if(isset($regemp000[0])){

            return $regemp000[0]->id;
        }

        $regemp000 = new regemp000;
        $regemp000['idUsuReg'] = auth()->user()->id;
        $regemp000['idPrpReg'] = auth()->user()->id;
        $regemp000['idUsuEdt'] = auth()->user()->id;
        $regemp000['idRegEnt'] = $Request['idRegEnt'];
        $regemp000['idRegPsa'] = $Request['idRegPsa'];
        $regemp000['SitReg'] = 1;
        $regemp000['SitEmp'] = 0;
        $regemp000['CapEmp'] = trataValor($Request['CapEmp']);
        $regemp000['NatJur'] = $Request['NatJur'];
        $regemp000['CodCne'] = $Request['CodCne'];
        $regemp000->save();
    	return $regemp000->id; 
    }




    public function idSitReg($idSitReg = null)
    {
        $idSitRegs =[
            '0' => 'Inativa',
            '1' => 'Ativa'
        ];

        if (!$idSitReg)
            
            return $idSitRegs;

        return $idSitRegs[$idSitReg];

    }


    
}
