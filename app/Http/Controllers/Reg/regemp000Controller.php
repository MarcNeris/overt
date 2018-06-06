<?php

namespace App\Http\Controllers\Reg;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Models\regent000;
use App\Models\regpsa000;
use App\Models\regemp000;
use App\Models\regempusu;
use App\Models\regend000;
use App\Models\regcto000;
use App\Models\users0001;
use Carbon\Carbon;
use Session;
use Gate;
use DB;

class regemp000Controller extends Controller
{
    public function new_regemp000(Request $Request, 
        regent000 $regent000,
        regpsa000 $regpsa000,
        regemp000 $regemp000,
        regend000 $regend000,
        regcto000 $regcto000,
        regempusu $regempusu,
        users0001 $users0001
        )
    {   

        $data=$Request->all();

        DB::beginTransaction();

        $idRegEnt=$regent000->new_regent000($data);
        $data['idRegEnt']=$idRegEnt;
        $idRegPsa=$regpsa000->new_regpsa000($data);
        $data['idRegPsa']=$idRegPsa;
        $idRegEmp=$regemp000->new_regemp000($data);
        $data['idRegEmp']=$idRegEmp;
        $idRegEnd=$regend000->new_regend000($data);
        $idEmpUsu=$regempusu->new_regempusu($data);
        $users0001->new_users0001($data);
        $i=0;   
        while(null!==(Input::get('CNT'.$i))){

            $data['TipCto'] = 1;//1 Socio
            $data['NomCto'] = Input::get('CNT'.$i);
            $data['CodCrg'] = 0;
            $data['NomCrg'] = Input::get('CRG'.$i);
            $data['TelCto'] = Input::get('TEL'.$i);
            $data['EmlCto'] = Input::get('EML'.$i);
            $idRegCto=$regcto000->new_regcto000($data);
            $i++;
        }

        if($regent000&&$regpsa000&&$regend000){
            $response = DB::commit();

            ativaEmpresa($idRegEmp);


        	return redirect()
        		->back()
        		->with('success',$response['message']);
        }

        DB::rollback();          

        return redirect()
        	->back()
        	->with('errors');
    }




    public function get_regemp000(){

        $regemp000s = regemp000::select(
         'regempusus.idRegEmp'
        ,'regpsa000s.RegFed'
        ,'regpsa000s.NomPsa'
        ,'users.name as NomPrp'
        ,'regempusus.SitEmp'
        )
        ->join('regpsa000s', 'regemp000s.idRegPsa', '=', 'regpsa000s.id')
        ->join('regempusus', 'regempusus.idRegEmp', '=', 'regemp000s.id')
        ->join('users',      'regempusus.idPrpEnt', '=', 'users.id')
        ->where('regempusus.user_id', auth()->user()->id)
        ->get()->toArray();

        return datatables()->of($regemp000s)->toJson();
    }




    public function empresas(){

        return view('reg.empresas');
    }




    public function empresa(){

        if(erp()->CodEmp){
            
            if (Gate::denies('Criar Empresa', Session::get('idRegEmp'))) {

                abort(403, 'Olá, a função "Criar Empresa" não está disponível para seu perfil nesta Entidade.');
            }
        }

        return view('reg.empresa');
    }




    public function atv_regemp000($idRegEmp){
        $idRegEmp=ativaEmpresa($idRegEmp);
        return (Session::get('NomFta'));
    }
}