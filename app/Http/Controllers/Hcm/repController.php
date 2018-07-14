<?php

namespace App\Http\Controllers\Hcm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\hcmcol000;
use App\Http\Controllers\FB;
use Session;


class repController extends Controller
{
    
    public function monitoramento($UsuUid){

         $RegFed = Session::get('RegFed');

        return view('hcm.monitoramento', compact('UsuUid','RegFed'));

    }


    public function rep(){

        $RegFed = Session::get('RegFed');
    	
    	return view('hcm.rep', compact('RegFed'));
    }

    

    public function upd_repusers(Request $Request){

    	$Request = json_decode($Request, true);

    	

    	$data = 'hello world';

    	return response()->json($data);
    }


    public function get_hcmcol000(){

        $hcmcol000s = hcmcol000::all();

        return datatables()->of($hcmcol000s)->toJson();
    }
}
