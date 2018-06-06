<?php

namespace App\Http\Controllers\Reg;

use Illuminate\Database\QueryException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\users0001;
use App\Models\Senior\erpemp000;
use App\Models\regempusu;
use App\Models\usersrole;
use App\Models\logeml001;
use App\Mail\overtMail;
use Carbon\Carbon;
use App\User;
use Session;
use Gate;
use Mail;
use Log;
use DB;


class users0001Controller extends Controller
{
    public function usuarios(){

    	return view('reg.usuarios');
    }



    public function usuario(){

        if (Gate::denies('Criar Usuário', Session::get('idRegEmp'))) {

            abort(403, 'Olá, a função "Criar Usuário" não está disponível para seu perfil nesta Empresa.');
        }

    	return view('reg.usuario');
    }

    public function usuarioEmpresa(){

        return view('reg.usuarioEmpresa');
    }



    public function new_users0001(Request $Request,
    	users0001 $users0001,
    	regempusu $regempusu,
    	logeml001 $logeml001,
    	User $User
    	)
    {
    	
    	$data=$Request->all();

        $data['idRegEnt']=Session::get('idRegEnt');
        $data['idRegEmp']=Session::get('idRegEmp');
        $EmlDst = strtolower($data['EmlUsu']);
        $data['EmlUsu'] =$EmlDst;
        $user_id =  User::where('email', $data['EmlUsu'])->value('id');
        $data['user_id']  = $user_id;

        if(!isset($user_id)){

            $password = rand(100000,999999);
            $user = new User;
            $user->name = $data['NomUsu'];
            $user->email = $data['EmlUsu'];
            $user->password =  bcrypt($password);
            $user->save();
            $user_id = $user->id;
            $data['user_id']  = $user_id;
        }

        try {
            
            $idRegUsu = $users0001->new_users0001($data);
                        $regempusu->new_regempusu($data);
            
        } catch (\PDOException $e) {

            //dd($e->getMessage());
            $Request->session()->flash('alert-success', 'Usuário já Cadastrado');
            //return redirect()->back();
        }


        $data['NomDst'] = $data['NomUsu'];
        $data['EmlDst'] = $data['EmlUsu'];
        $data['NomEmt'] = auth()->user()->name;
        $data['EmlEmt'] = auth()->user()->email;
        $data['EmlTit'] = isset($password)?'Dados para acesso Sistema.':'Painel de Gestão.';
        $data['EmlDsc'] = isset($password)?'Login:"'.$data['EmlUsu'].'" Senha:"'.$password.'"':'Convite Para Acesso.';
        $data['EmlFin'] = 'O objetivo deste email é autorizar seu acesso ao Painel de Gestão.';

        $logeml001 = $logeml001->new_logeml001($data);

        $idLogEml = logeml001::find($logeml001);

        $EmlDst = Mail::to($EmlDst)->queue(new overtMail($idLogEml));
        return redirect()->back();
    }




    public function get_users0001()
    {
        $users0001s = users0001::select(
         'users0001s.id'
        ,'users.name as NomUsu'
        ,'regpsa000s.NomFta'
        ,'regpsa000s.RegFed'
        ,'users.email as EmlUsu'
        ,'usersroles.NomRol'
        ,'users0001s.SitUsu')
        ->join('users', 'users.id', '=', 'users0001s.user_id')
        ->join('usersroles', 'users0001s.idRegRol', '=', 'usersroles.id')
        ->join('regemp000s', 'users0001s.idRegEmp', '=', 'regemp000s.id')
        ->join('regpsa000s', 'regemp000s.idRegPsa', '=', 'regpsa000s.id')
        ->where('users0001s.idRegEnt', Session::get('idRegEnt'))
        //->where('users0001s.idPrpReg', auth()->user()->id)
        ->where('users0001s.user_id','<>',auth()->user()->id)
        ->where('users0001s.SitReg', 1)
        ->get();

        return datatables()->of($users0001s)->toJson();
    }




    public function get_usuarioEmpresa(){
        $users0001s = users0001::select(
         'users.name as  NomUsu'
        ,'users.email as EmlUsu'
        ,'regpsa000s.NomFta'
        ,'regpsa000s.RegFed'
        ,'usersroles.CodRol'
        ,'usersroles.NomRol'
        ,'users0001s.SitReg'
        ,'users0001s.SitUsu'
        )//,'regpsa000s.RegFed','regpsa000s.NomPsa','regemp000s.CodCne','regemp000s.SitEmp')
        ->join('users', 'users.id', '=', 'users0001s.idPrpReg')
        ->join('usersroles', 'users0001s.idRegRol', '=', 'usersroles.id')
        ->join('regemp000s', 'users0001s.idRegEmp', '=', 'regemp000s.id')
        ->join('regpsa000s', 'regemp000s.idRegPsa', '=', 'regpsa000s.id')
        ->where('users0001s.EmlUsu', auth()->user()->email)
        ->where('users0001s.idPrpReg','<>',auth()->user()->id)
        ->where('users0001s.user_id', auth()->user()->id)
        ->where('users0001s.SitReg', 1)
        ->get()->toArray();

        return datatables()->of($users0001s)->toJson();
    }



    public function get_usuario($email){

        $email = strtolower($email);
        
        $users0001s = users0001::select(
         'users.name as  NomUsu'
        ,'users.email as EmlUsu'
        ,'regpsa000s.NomFta'
        ,'regpsa000s.RegFed'
        ,'usersroles.id as idRegRol'
        ,'usersroles.DscRol'
        ,'usersroles.NomRol'
        ,'users0001s.SitReg'
        ,'users0001s.SitUsu'
        )//,'regpsa000s.RegFed','regpsa000s.NomPsa','regemp000s.CodCne','regemp000s.SitEmp')
        ->join('users', 'users.id', '=', 'users0001s.user_id')
        ->join('usersroles', 'users0001s.idRegRol', '=', 'usersroles.id')
        ->join('regemp000s', 'users0001s.idRegEmp', '=', 'regemp000s.id')
        ->join('regpsa000s', 'regemp000s.idRegPsa', '=', 'regpsa000s.id')
        ->where('users0001s.EmlUsu', $email)
        ->where('users0001s.idPrpReg','=', auth()->user()->id)
        //->where('users0001s.user_id', auth()->user()->id)
        ->where('users0001s.SitReg', 1)
        ->first()->toArray();

        return response()->json($users0001s);
    }
    //********************************************************************//
    //
    //Ativar Usuários na Base
    //
    //********************************************************************//
    public function atv_users0001($id){

        if (Gate::denies('Alterar Usuário', Session::get('idRegEmp'))) {

            abort(403, 'Olá, a função "Alterar Usuário" não está disponível para seu perfil nesta Empresa.');
        }

        $users0001 = users0001::find($id);


            $erpemp000=erpemp000::where('user_id', $users0001->user_id)->delete();
        
        if ($users0001->SitUsu==0){
            $users0001->SitUsu=1;
            $users0001->save();
        } else {
            $users0001->SitUsu=0;
            $users0001->save();
        }

        return $users0001->SitUsu;

    }
    //********************************************************************//
    //
    //Gerenciar Permissões
    //
    //********************************************************************//
    public function usuarioPerfil($idUsers0001){

        if (Gate::denies('Alterar Usuário', Session::get('idRegEmp'))) {

            abort(403, 'Olá, a função "Alterar Usuário" não está disponível para seu perfil nesta Empresa.');
        }



        $idRegRol = users0001::where('id', $idUsers0001)->where('idRegEnt', Session::get('idRegEnt'))->value('idRegRol');

        $user_id = users0001::where('id', $idUsers0001)->where('idRegEnt', Session::get('idRegEnt'))->value('user_id');

        $usersrole = usersrole::where('SitReg',1)->where('id', $idRegRol)->with('roles')->first();

        //dd($usersrole);

        $User = User::select('id','name','email')->find($user_id);

        return view('reg.usuarioPerfil', compact('User','usersrole','idUsers0001'));

    }
    //********************************************************************//
    //
    //Atualizar usuário
    //
    //********************************************************************//
    public function upd_users0001($id, $idRegRol){
        if (Gate::denies('Alterar Usuário', Session::get('idRegEmp'))) {

            abort(403, 'Olá, a função "Alterar Usuário" não está disponível para seu perfil nesta Empresa.');
        }
        $users0001 = users0001::where('idRegEnt', Session::get('idRegEnt'))->find($id);
        $users0001->idRegRol = $idRegRol;
        $users0001->save();
        return $users0001->id;
    }
}
