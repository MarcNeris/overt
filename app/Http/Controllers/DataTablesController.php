<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
 

class DataTablesController extends Controller
{
    public function contatos(){

        return view('crm.contato');

        //return datatables()
          //  ->of(DB::table('users')
            //->select('id','email')
            //->where('id', Auth::user()->id))
            //->toJson();
    }

    public function getRowDetailsData()
    {
        
        return datatables()
            ->of(DB::table('crm000cnts')
            ->select('id', 'nome_contato', 'sobrenome', 'telefone', 'email_pessoal','created_at')
            ->where('users', Auth::user()->id))
            ->toJson();
    }
}
