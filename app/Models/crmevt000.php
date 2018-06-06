<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;



class crmevt000 extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];




    public function new_crmevt000($Request)
    {	
        if(isset($Request['HraIni']))
           $Request['DatIni']=$Request['DatIni'].' '.$Request['HraIni'];

        if(isset($Request['HraFim']))
           $Request['DatFim']=$Request['DatFim'].' '.$Request['HraFim'];

        if ($Request['NomEvt']=='')
            $Request['NomEvt']='Novo evento';

    	$this->idUsuReg		= auth()->user()->id;
     	$this->idPrpReg	    = auth()->user()->id;
        $this->idUsuEdt     = auth()->user()->id;
     	$this->idEntPrp	    = 1;
     	$this->idOrgPrp	    = 1;
     	$this->idUndPrp	    = 1;
        $this->SitReg       = 1;
     	$this->NomEvt 		=$Request['NomEvt'];
     	$this->DatIni 		=Carbon::createFromFormat('d/m/Y H:i:s', $Request['DatIni'].':00')->format('Y-m-d H:i:s');
     	$this->DatFim 		=Carbon::createFromFormat('d/m/Y H:i:s', $Request['DatFim'].':00')->format('Y-m-d H:i:s');
     	$this->CorEvt		= '#3c8dbc';

     	$message=$this->save();

     	if($message)
    		return [
    			'success' => true,
    			'message' => 'Salvo Com Sucesso!'
    		];

    	return [
    		'success' => false,
    		'message' => 'Falha ao Salvar'
    	];
    }

    

    public function upd_crmevt000($Request)
    {	
        if(isset($Request['HraIni']))
           $Request['DatIni']=$Request['DatIni'].' '.$Request['HraIni'];

        if(isset($Request['HraFim']))
           $Request['DatFim']=$Request['DatFim'].' '.$Request['HraFim'];

    	$crmevt000 				= crmevt000::find($Request['id']);
        $crmevt000->idUsuEdt    = auth()->user()->id;
     	$crmevt000->NomEvt 		= $Request['NomEvt'];
     	$crmevt000->DatIni 		= Carbon::createFromFormat('d/m/Y H:i:s', $Request['DatIni'].':00')->format('Y-m-d H:i:s');
     	$crmevt000->DatFim 		= Carbon::createFromFormat('d/m/Y H:i:s', $Request['DatFim'].':00')->format('Y-m-d H:i:s');

     	$message=$crmevt000->save();

    	if($message)
    		return [
    			'success' => true,
    			'message' => 'Alterado Com Sucesso!'
    		];

    	return [
    		'success' => false,
    		'message' => 'Falha ao Alterar'
    	];
    }
}
