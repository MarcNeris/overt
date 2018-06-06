<?php

namespace App\Models\Senior;

use Illuminate\Database\Eloquent\Model;

class erptns000 extends Model
{
    public function new_erptns000($Request)
    {
    	$erptns000 = new erptns000;
    	$erptns000['id'] = $Request['CodEmp'].soNumero($Request['CodTns']);
    	$erptns000['idPrpReg'] = auth()->user()->id;
    	$erptns000['CodEmp'] = $Request['CodEmp'];
    	$erptns000['CodTns'] = $Request['CodTns'];
    	$erptns000['DesTns'] = $Request['DesTns'];
    	$erptns000['LisMod'] = $Request['LisMod'];
    	$erptns000['SitTns'] = 1;
       
		 
		try{
           	
           	$erptns000->save();
           	return $erptns000->id;
                                    
       	} catch (\PDOException $e) {
        	
       		//dd($e->getMessage());
        }

        

    }
}
