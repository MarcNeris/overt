<?php

namespace App\Http\Controllers\crm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use App\Models\crmcta000;
use App\Models\regpsa000;
use App\Models\regend000;
use App\Models\regcto000;
use Session;
use DB;

class crmcta000Controller extends Controller
{
    public function get_crmcta000(){
        $regemp000s = crmcta000::select('crmcta000s.id','regpsa000s.RegFed','regpsa000s.NomPsa','crmcta000s.CodCne','crmcta000s.SitCta')
            ->join('regpsa000s', 'regpsa000s.id', '=', 'crmcta000s.idRegPsa')
            ->where('crmcta000s.idUsuReg', auth()->user()->id)
            ->where('crmcta000s.idRegEnt', $EmpUsu=Session::get('idRegEnt'))
            ->get();
        return datatables()->of($regemp000s)->toJson();
    }


    public function new_crmcta000(Request $Request,
        regpsa000 $regpsa000,
        regend000 $regend000,
        crmcta000 $crmcta000,
        regcto000 $regcto000
        )
    {

        //Registro de uma Conta nova
        $data=$Request->all();

        DB::beginTransaction();

        $data['idRegEnt']=Session::get('idRegEnt');
        $idRegPsa=$regpsa000->new_regpsa000($data);
        $data['idRegPsa']=$idRegPsa;
        $data['idRegEmp']=Session::get('idRegEmp');
        $idRegEnd=$regend000->new_regend000($data);
        $idRegCta=$crmcta000->new_crmcta000($data);

      
        $i=0;   
        while(null!==(Input::get('CNT'.$i))){

            $data['TipCto'] = 2;// Contato
            $data['NomCto'] = Input::get('CNT'.$i);
            $data['CodCrg'] = 1;
            $data['NomCrg'] = Input::get('CRG'.$i);
            $data['TelCto'] = Input::get('TEL'.$i);
            $data['EmlCto'] = Input::get('EML'.$i);
            $idRegCto=$regcto000->new_regcto000($data);
            $i++;
        }


        if($regpsa000&&$regend000&&$crmcta000){
            $response = DB::commit();
            return redirect()
                ->back()
                ->with('success',$response['message']);
        } 

        DB::rollback();          

        return redirect()
            ->back()
            ->with('errors');
    }
}
