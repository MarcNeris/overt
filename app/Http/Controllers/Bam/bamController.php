<?php

namespace App\Http\Controllers\Bam;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\bamprd000;
use App\Models\bamprd001;
use App\Models\regempusu;
use App\Models\users0001;
use App\Jobs\getBamJob;
use Session;
use Gate;
use DB;
use Log;
use App\User;

class bamController extends Controller
{
    //********************************************************************//
    //ROTA BAM -> bam/dashboard
    //********************************************************************//
    public function BAM(){

        return redirect()->route('bam.dashboard');
    }
    //********************************************************************//
    //ROTA dasboard -> bam/dashboard
    //********************************************************************//
    public function dashboard()
    {   
        ativaModulo('BAM');         

        return view('bam.dashboard');
    }
    //
    //
    //
    public function financas()
    {   
        if (Gate::denies('Finanças', Session::get('idRegEmp'))) {

            abort(403, 'Olá, a Permissão "Finanças" não está disponível para seu perfil nesta Empresa.');
        }
        
        ativaModulo('BAM');
        return view('bam.financas');
    }
    //
    //
    //
    public function producao()
    {   
        ativaModulo('BAM');
        return view('bam.producao');
    }
    //
    //
    //
    public function hcm()
    {   
        if (Gate::denies('Recursos Humanos', Session::get('idRegEmp'))) {

            abort(403, 'Olá, a Permissão "Recursos Humanos" não está disponível para seu perfil nesta Empresa.');
        }
        ativaModulo('BAM');
        return view('bam.hcm');
    }
    //
    //
    //
    public function operacoes()
    {   
        if (Gate::denies('Operações', Session::get('idRegEmp'))) {

            abort(403, 'Olá, a Permissão "Operações" não está disponível para seu perfil nesta Empresa.');
        }
        ativaModulo('BAM');
        return view('bam.operacoes');
    }
    //
    //
    //
    public function faturamento()
    {   
        if (Gate::denies('Finanças', Session::get('idRegEmp'))) {

            abort(403, 'Olá, a Permissão "Finanças" não está disponível para seu perfil nesta Empresa.');
        }
        ativaModulo('BAM');
        return view('bam.faturamento');
    }
    //
    //
    //
    public function controladoria()
    {   
        if (Gate::denies('Controladoria', Session::get('idRegEmp'))) {

            abort(403, 'Olá, a Permissão "Controladoria" não está disponível para seu perfil nesta Empresa.');
        }
        ativaModulo('BAM');
        return view('bam.controladoria');
    }
    //
    //
    //
    public function top5()
    {   
        if (Gate::denies('Finanças', Session::get('idRegEmp'))) {

            abort(403, 'Olá, a Permissão "Finanças" não está disponível para seu perfil nesta Empresa.');
        }
        ativaModulo('BAM');
        return view('bam.top5');
    }
}
