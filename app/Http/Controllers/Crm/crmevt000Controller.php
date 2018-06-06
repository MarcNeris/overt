<?php

namespace App\Http\Controllers\Crm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\crmevt000;
use App\Http\Requests\crmevt000Request;




class crmevt000Controller extends Controller
{
    public function new_crmevt000(crmevt000Request $Request, crmevt000 $crmevt000)
    {
    
    	$response=$crmevt000->new_crmevt000($Request->all());

    	if ($response['success'])
        	return redirect()
        		->back()
        		->with('success',$response['message']);

        return redirect()
        	->back()
        	->with('errors');
    }


    public function get_crmevt000()
    {
        $events = crmevt000::select("id","NomEvt as title", "DatIni as start", "DatFim as end","CorEvt as color")->get()->toArray();
        return response()->json($events);
    }

    public function upd_crmevt000(crmevt000Request $Request, crmevt000 $crmevt000)
    {
    	
        $response=$crmevt000->upd_crmevt000($Request->all());

    	if ($response['success'])
        	return redirect()
        		->back()
        		->with('success',$response['message']);

        return redirect()
        	->back()
        	->with('errors');
    }
}
