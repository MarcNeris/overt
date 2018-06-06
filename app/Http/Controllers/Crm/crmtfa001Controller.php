<?php

namespace App\Http\Controllers\Crm;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\crmtfa001;
use App\Http\Requests\crmtfa001Request;

class crmtfa001Controller extends Controller
{
    public function get_crmtfa001()
    {
    	
    	$crmtfa001s = crmtfa001::select(
    		'crmtfa001s.id as 0',
    		'crmtfa001s.LinTfa as 1',
    		'crmtfa001s.ColTfa as 2',
    		'crmtfa001s.CorTfa as 3',
    		'crmtfa001s.NomTfa as 4')
            ->join('crmtfa000s','crmtfa001s.crmtfa000s','=','crmtfa000s.id')
            ->where('crmtfa001s.users', Auth::user()->id)
            ->where('crmtfa001s.UsuTfa', Auth::user()->id)
            ->where('crmtfa001s.SitTfa','0')
    		->get()->toArray();
        return response()->json($crmtfa001s);
    }

    public function upd_crmtfa001(crmtfa001Request $Request, crmtfa001 $crmtfa001)
    {

        //dd($Request->all());
    	
    	$response=$crmtfa001->upd_crmtfa001($Request->all());
    	
    }

    public function new_crmtfa001()
    {
    	
    }
}
