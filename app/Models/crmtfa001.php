<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class crmtfa001 extends Model
{
    public function upd_crmtfa001($request)
    {
    	
    	$request=$request['dataRows'];
    	$dataRows = json_decode($request, TRUE);
    
    	foreach ($dataRows as $dataRow) {
			$crmtfa001 			= crmtfa001::find($dataRow[0]);
			$crmtfa001->ColTfa 	= $dataRow[2];
			$crmtfa001->LinTfa 	= $dataRow[1];
			$crmtfa001->save();
	    };
    }
}