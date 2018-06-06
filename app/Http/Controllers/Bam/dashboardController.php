<?php

namespace App\Http\Controllers\Bam;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Senior\e140nfv;
use App\Models\Senior\e900eoq;
use App\Models\Senior\e605ext;
use App\Models\Senior\e640lot;
use App\Models\Senior\e640lct;
use App\Models\Senior\r034fun;
use DB;

class dashboardController extends Controller
{
    //********************************************************************//
	//
	//PAINEL DASHBOARD bam/dasboard
	//
	//********************************************************************//
	public function e600mcc(){
		//********************************************************************//
		//********************************************************************//
		//ULTIMA MOVIMENTACAO DE NOTA FISCAL
		//********************************************************************//
		//********************************************************************//
		$DatNfv = e140nfv::whereIn('e140nfv.CodEmp', erp()->CodEmp)
		->where('SitNfv', 2)
		->max('DatEmi');
		$data['DatNfv'] = isset($DatNfv)?$DatNfv:'1900-12-31 00:00:00';
		//********************************************************************//
		//QUANTIDADE DE NOTAS FISCAIS
		//********************************************************************//
		$QtdNfv = e140nfv::whereIn('e140nfv.CodEmp', erp()->CodEmp)
		->where('SitNfv', 2)
		->select(DB::raw('count(DatEmi) AS QtdNfv'))
		->first()->toArray();
		$data['QtdNfv'] = $QtdNfv['QtdNfv'];
		//********************************************************************//
		//ULTIMA MOVIMENTACAO DE OP
		//********************************************************************//
		$DatEoq = e900eoq::whereIn('e900eoq.CodEmp', erp()->CodEmp)
		->max('DatRea');
		$data['DatRea'] = isset($DatEoq)?$DatEoq:'1900-12-31 00:00:00';
		//********************************************************************//
		//QUANTIDADE DE OP
		//********************************************************************//
		$QtdRea = e900eoq::whereIn('e900eoq.CodEmp', erp()->CodEmp)
		->select(DB::raw('count(CodEmp) AS QtdRea'))
		->first()->toArray();
		$data['QtdRea'] = $QtdRea['QtdRea'];
		//********************************************************************//
		//ULTIMA CONCILIACAO
		//********************************************************************//
		$DatCnc = e605ext::whereIn('e605ext.CodEmp', erp()->CodEmp)
		->where('UsuCnc','<>','0')
		->max('DatExt');
		$data['DatCnc'] = isset($DatCnc)?$DatCnc:'1900-12-31 00:00:00';
		//********************************************************************//
		//QUANTIDADE DE LANCAMENTOS CONCILIADOS
		//********************************************************************//
		$QtdCnc = e605ext::whereIn('e605ext.CodEmp', erp()->CodEmp)
		->where('UsuCnc','<>','0')
		->select(DB::raw('count(CodEmp) AS QtdCnc'))
		->first()->toArray();
		$data['QtdCnc'] = $QtdCnc['QtdCnc'];
		//********************************************************************//
		//ÚLTIMO LANCAMENTO CONTABIL
		//********************************************************************//
		$DatLot = e640lot::whereIn('e640lot.CodEmp', erp()->CodEmp)
		->where('SitLot', 2)
		->whereDate('DatLot','<=', date('Y-m-d'))
		->max('DatLot');
		$data['DatLot'] = $DatLot;
		//********************************************************************//
		//QUANTIDADE DE LANCAMENTOS CONCILIADOS
		//********************************************************************//
		$QtdLct = e640lct::whereIn('e640lct.CodEmp', erp()->CodEmp)
		->where('SitLct', 2)
		->where('TipLct', 1)
		->select(DB::raw('count(NumLct) AS QtdLct'))
		->first()->toArray();
		$data['QtdLct'] = $QtdLct['QtdLct'];
	
		return response()->json($data);
	}
}
