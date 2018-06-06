<?php

namespace App\Http\Controllers\Crm;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\crmtfa000;

class crmtfa000Controller extends Controller
{
    public function get_crmtfa000()
    {
    	
    	$crmtfa000 = crmtfa000::select(
    		'crmtfa000s.id',
    		'crmtfa000s.NomTfa',
    		'crmtfa000s.SitTfa')
            //->join('crmtfa001s','crmtfa000s.id','=','crmtfa001s.crmtfa000s')
    		->where('crmtfa000s.users', Auth::user()->id)
    		->get()->toArray();
        return response()->json($crmtfa000);
    }
}
