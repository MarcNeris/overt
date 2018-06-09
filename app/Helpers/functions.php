<?php

use App\Models\regemp000;
use App\Models\Senior\erpemp000;

//********************************************************************//
//
//LIMPA '$R' DOS CAMPOS PARA SALVAR EM BANCO
//
//********************************************************************//
function trataValor($valor)
{
    $verificaPonto = ".";
        if(strpos("[".$valor."]", "$verificaPonto")):
            $valor = str_replace('.','', $valor);
            $valor = str_replace(',','.', $valor);
            $valor = str_replace('R$ ','', $valor);
        else:
            $valor = str_replace(',','.', $valor);
            $valor = str_replace('R$ ','', $valor);  
        endif;

   return $valor;
};
//********************************************************************//
//
//RETORNA OBJETO COM EMPRESAS E FILIAS DO SAPIENS
//
//********************************************************************//

function vetorh(){
    return 'vetorh';
}

function sapiens(){
    return 'sapiens';
}

function erp(){
    
    $erpemp000s = erpemp000::select('id','CodEmp','SigEmp','CodFil','SigFil','SitEmp')
        ->where('user_id', auth()->user()->id)
        ->where('SitEmp', 1)
        ->get()
        ->toArray();

        $CodEmp=[];
        $CodFil=[];

        foreach ($erpemp000s as $erpemp000) {
            $CodEmp[] = $erpemp000['CodEmp'];
            $CodFil[] = $erpemp000['CodFil'];
        }

    $erp = new \stdClass();

    $erp->CodEmp = array_unique($CodEmp);
    $erp->CodFil = array_unique($CodFil);

    return $erp;
}


function sumDay($Date, int $days){
    
    $newDate = date('Y-m-d', strtotime($Date."$days days"));
    
    return $newDate;
}
//********************************************************************//
//
//LIMPA MASCARA DO CNPJ, MANTENDO APENAS NÚMEROS
//
//********************************************************************//
function trataCNPCPF($string)
{
    $string=preg_replace("/\D+/", "", $string);
    return $string;
};
//********************************************************************//
//
//LIMPA MASCARA DE STRING, MANTENDO APENAS NÚMEROS
//
//********************************************************************//
function soNumero($str)
{
    return preg_replace("/[^0-9]/", "", $str);
}
//********************************************************************//
//
//ATIVA O MODULO QUE ESTA SENDO USADO
//
//********************************************************************//
function ativaModulo($module = null){

    Session::put('module', $module);
}
//********************************************************************//
//
//ARRAY COM TABELA DE MESES DECRESCENTE
//
//********************************************************************//
function Meses(){
    $Meses=[['Dez',12],['Nov',11],['Out',10],['Set',9],['Ago',8],['Jul',7],['Jun',6],['Mai',5],['Abr',4],['Mar',3],['Fev',2],['Jan',1]];
    return $Meses;
}
//********************************************************************//
//
//ATIVA EMPREASAS DISPONIVEIS POR USUARIO
//
//********************************************************************//
function ativaEmpresa($idRegEmp=null)
{
    $SitEmp = 1;

    if (isset($idRegEmp)){

        DB::table('regempusus')
        ->where('idRegEmp','<>',$idRegEmp)
        ->where('user_id',Auth::user()->id)
        ->update(['SitEmp'=>'0']);
        DB::table('regempusus')
        ->where('idRegEmp',$idRegEmp)
        ->where('user_id',Auth::user()->id)
        ->update(['SitEmp'=>$SitEmp]);
    }


    $EmpUsu = regemp000::select(
     'regempusus.idPrpEnt'
    ,'regempusus.idRegEnt'
    ,'regempusus.idRegEmp'
    ,'regpsa000s.NomFta'
    ,'regpsa000s.NomPsa')
    ->join('regempusus', 'regempusus.idRegEmp', '=', 'regemp000s.id')
    ->join('users0001s', 'users0001s.idRegEmp', '=', 'regemp000s.id')
    ->join('regpsa000s', 'regemp000s.idRegPsa', '=', 'regpsa000s.id')
    ->where('regempusus.SitEmp', $SitEmp)
    ->where('users0001s.SitUsu', 1)
    ->where('users0001s.user_id', auth()->user()->id)
    ->where('regempusus.user_id', auth()->user()->id)
    ->first();

    if(isset($EmpUsu)){

        Session::put(['NomEmp', $EmpUsu->NomPsa]);
        Session::put('NomFta',  str_limit($EmpUsu->NomFta, 21));
        Session::put('idPrpEnt',$EmpUsu->idPrpEnt);
        Session::put('idRegEnt',$EmpUsu->idRegEnt);
        Session::put('idRegEmp',$EmpUsu->idRegEmp);
        return  true;
    }

    return  false;
}

//********************************************************************//
//
// Shortens a number and attaches K, M, B, etc. accordingly
//
//********************************************************************//
function shortNumber($number, $precision = 0, $divisors = null) {

    // Setup default $divisors if not provided
    if (!isset($divisors)) {
        $divisors = array(
            pow(1000, 0) => '', // 1000^0 == 1
            pow(1000, 1) => 'K', // Thousand
            pow(1000, 2) => 'M', // Million
            pow(1000, 3) => 'B', // Billion
            pow(1000, 4) => 'T', // Trillion
            pow(1000, 5) => 'Qa', // Quadrillion
            pow(1000, 6) => 'Qi', // Quintillion
        );    
    }

    foreach ($divisors as $divisor => $shorthand) {
        if (abs($number) < ($divisor * 1000)) {
            break;
        }
    }

    return number_format($number / $divisor, $precision) . $shorthand;
}