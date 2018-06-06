<?php

namespace App\Http\Controllers\Reg;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\regcto000;
use App\Models\regmun000;


class regcto000Controller extends Controller
{
    

    public function new_regcto000(Request $Request){

    	dd($Request->all());
    }


    public function contatos(){

    	return view('reg.contatos');
    }


    //Contatos
    public function get_regcto000(){
        $regcto000s = regcto000::select('regcto000s.id',
        								'regcto000s.NomCto',
        								'regcto000s.NomCrg',
        								'regcto000s.TelCto',
        								'regcto000s.EmlCto',
        								'regpsa000s.NomPsa')
            ->join('crmcta000s', 'crmcta000s.id', '=', 'regcto000s.idRegCta')
            ->join('regpsa000s', 'regpsa000s.id', '=', 'crmcta000s.idRegPsa')
            ->where('regcto000s.idUsuReg', auth()->user()->id)
            ->where('regcto000s.idRegEnt', $EmpUsu=Session::get('idRegEnt')) 
            ->get();
        return datatables()->of($regcto000s)->toJson();
    }





    public function get_regcto000xxxxxx(){
        $regmun000s = regmun000::select('regmun000s.id','regmun000s.NomMun')
            //->join('regpsa000s', 'regpsa000s.id', '=', 'regemp000s.idRegPsa')
            //->where('regcto000s.idUsuReg', auth()->user()->id)
            ->get();
        return datatables()->of($regmun000s)->toJson();
    }



}
