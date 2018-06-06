<?php

namespace App\Http\Controllers\Crm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\regemp000;
use Session;
use Mail;
use Gate;


class crmController extends Controller
{
    
    public function crm()
    { 
        if (Gate::denies('CRM', Session::get('idRegEmp'))) {
           abort(403, Session::get('NomFta').' | Esta Empresa/Entidade não este sistema ativo.');
        } 
        
        ativaModulo('CRM');

        return view('crm.tarefas');
    }


    public function tarefas()
    {   
        return view('crm.tarefas');
    }


    public function dashboard(Request $Request)
    {

        return view('crm.dashboard');
    }


    public function contas()
    {
        return view('crm.contas');
    }


    public function conta()
    {
        return view('crm.conta');
    }


    public function planodevoo()
    {
        return view('crm.planodevoo');
    }


    public function contact()
    {
    	return view('crm000cnt');
    }


    public function settings()
    {
    	return view('crm.settings');
    }


    public function empresas()
    {
        $regemp000s = regemp000::where('idUsuReg',auth()->user()->id)->paginate(2);
        return view('crm.empresas',compact('regemp000s'));
    }


    public function contatos()
    {
        return view('crm.contatos');
    }
}
