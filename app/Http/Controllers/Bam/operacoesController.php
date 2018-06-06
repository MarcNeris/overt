<?php

namespace App\Http\Controllers\Bam;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Senior\e900eoq;
use App\Models\Senior\e900cop;
use App\Models\Senior\e120Ped;
use App\Models\Senior\e420ocp;
use App\Models\Senior\e906ope;
use App\Models\Senior\e075pro;

class operacoesController extends Controller
{
    //********************************************************************//
	//
	//PAINEL OPERACOES bam/operacoes
	//
	//********************************************************************//
	//********************************************************************//
	//Listar Ordens de Produção da e900cop
	//********************************************************************//
	public function get_e900cop(){
	 	$e900cop = e900cop::join('e075pro', function ($join) {$join
		->on('e075pro.CodEmp','e900cop.CodEmp')
    	->on('e075pro.CodPro','e900cop.CodPro');
        })
    	->whereIn('e900cop.CodEmp', erp()->CodEmp)
    	->whereIn('SitOrp', ['L','A','R'])
    	->get(['NumOrp','e900cop.CodPro','DesPro','QtdPrv','CodFil','NumPed','DtpIni','DtpFim']);

    	return datatables()->of($e900cop)->toJson();
	}
	//********************************************************************//
	//Listar Ordens de Produção da e900cop
	//********************************************************************//
    public function e900eoqCodProQtdOrp($NumOrp){
   
    	$e900eoq = e900eoq::join('e720opr', function ($join) {$join
		->on('e720opr.CodEmp','e900eoq.CodEmp')
    	->on('e720opr.CodOpr','e900eoq.CodOpr');
        })
        ->join('r999usu','r999usu.CodUsu','e900eoq.CodUsu')
    	->whereIn('e900eoq.CodEmp', erp()->CodEmp)
    	->where('NumOrp', $NumOrp)
    	->where('FimOrp', 'S')
    	->first(['NumOrp','CodPro','CodDer','e720opr.DesOpr','NomUsu','DatRea','HorRea','QtdRe1','DatGer','QtdHrr','CodDep']);
        if($e900eoq){

            $e900eoq->QtdPrv = 60;
            $e900eoq->NomPrv = 'Meta';

        	$data['series'] = $e900eoq;
    		$data['DatLog'] = 'Último Movimento '.date('d/m/Y H:i:s', strtotime($e900eoq['DatRea']));
    		$data['TitBam'] = 'Monitoramento de OP '.$e900eoq['DesOpr'];
    		$data['SubTxt'] = 'ORP '.$e900eoq['NumOrp'].'-'.$e900eoq['CodPro'];
            
        	return response()->json($data);
        }

        $data['series'] = 'ORP sem Apontamentos...';
        $data['DatLog'] = 'Último Movimento '.date('d/m/Y H:i:s');
        $data['TitBam'] = 'Esta ORP Está sem Apontamentos';
        $data['SubTxt'] = 'ORP sem Apontamentos';

        return response()->json($data);
    }
    //********************************************************************//
    //ROTA MONITORAMENTO
    //********************************************************************//
    public function monitoramento($NumOrp){

        return view('bam.operacoesMonitoramento', compact('NumOrp'));
    }
    //********************************************************************//
    //PAINEL OPERACAOES
    //********************************************************************//
    //********************************************************************//
    //QUANTIDADE DE OPS EM ABERTO
    //********************************************************************//
    public function get_DshOpe(){
    $QtdOrp = e900cop::join('e075pro', function ($join) {$join
		->on('e075pro.CodEmp','e900cop.CodEmp')
    	->on('e075pro.CodPro','e900cop.CodPro');
        })
	->whereIn('e900cop.CodEmp', erp()->CodEmp)
	->whereIn('SitOrp', ['L','A','R'])
	->count();
    $data['QtdOrp'] = $QtdOrp;
    //********************************************************************//
	//QUANTIDADE DE APONTAMENTOS
	//********************************************************************//
    $QtdEoq = e900eoq::join('e720opr', function ($join) {$join
		->on('e720opr.CodEmp','e900eoq.CodEmp')
    	->on('e720opr.CodOpr','e900eoq.CodOpr');
        })
    ->count();
   	$data['QtdEoq'] = $QtdEoq;
    //********************************************************************//
    //QUANTIDADE DE PEDIDOS EM ABERTO
    //********************************************************************//
    $QtdPed = e120Ped::whereIn('CodEmp', erp()->CodEmp)
    ->whereIn('CodFil', erp()->CodFil)
    ->whereIn('SitPed',['1','2'])
    ->count();
    $data['QtdPed'] = $QtdPed;
    //********************************************************************//
    //QUANTIDADE DE ORDENS DE COMPRA EM ABERTO
    //********************************************************************//
    $QtdOcp = e420ocp::whereIn('CodEmp', erp()->CodEmp)
    ->whereIn('CodFil', erp()->CodFil)
    ->whereIn('SitOcp',['1','2'])
    ->count();
    $data['QtdOcp'] = $QtdOcp;
    //********************************************************************//
    //QUANTIDADE DE OPERADORES ATIVOS
    //********************************************************************//
    $QtdOpe = e906ope::whereIn('CodEmp', erp()->CodEmp)
    ->where('SitOpe', 'A')
    ->count();
    $data['QtdOpe'] = $QtdOpe;//QTD OPERADORES
    //********************************************************************//
    //QUANTIDADE DE PRODUTOS ATIVOS
    //********************************************************************//
    $QtdPro = e075pro::whereIn('e075pro.CodEmp', erp()->CodEmp)
    ->where('SitPro', 'A')
    ->where('TipPro', 'P')
    ->count();
    $data['QtdPro'] = $QtdPro;

    return response()->json($data);
    }
}
