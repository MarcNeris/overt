<?php

namespace App\Http\Controllers\Hcm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\hcmcol000;

class repController extends Controller
{
    
    public function monitoramento(){

    }


    public function rep(){

        return view('hcm.rep');


    	$email = auth()->user()->email;

    	//dd($email);

    	$email = 'marceloneris@hotmail.com';
    	$pass = 'angra@@2';

    	return view('hcm.rep', compact('email','pass'));
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
