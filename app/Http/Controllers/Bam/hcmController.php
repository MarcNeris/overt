<?php

namespace App\Http\Controllers\Bam;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Senior\r034fun;
use App\Models\Senior\r044cal;
use App\Models\Senior\r046ver;
use App\Models\Senior\r034cpl;

use DB;

class hcmController extends Controller
{
    //********************************************************************//
	//
	//PAINEL HCM bam/hcm
	//
	//********************************************************************//

	//********************************************************************//
	//
	//HCM FOLHA POR COLABORADOR
	//
	//********************************************************************//

	public function get_r044cal(){

		setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');

		$r044cals = r044cal::whereIn('r044cal.NumEmp', erp()->CodEmp)
		->whereIn('r044cal.TipCal', [11])
		->where('r044cal.SitCal', 'T')
		->take(12)
		->orderBy('DatPag', 'Desc')
		->get(['IniCmp','FimCmp','DatPag','CodCal']);

		$data=[];
		foreach ($r044cals as $key => $r044cal) {

				$data[$key]['CodCal']=$r044cal->CodCal;
				$data[$key]['DatPag']=date('d/m/Y', strtotime($r044cal->DatPag));
				$data[$key]['DatCmp']=strftime("%b/%Y", strtotime($r044cal->IniCmp));
		}

		return response()->json($data);
	}

	public function r046verCodColDesEve($codcal){

		$r034fun = r034cpl::join('r034fun', function ($join) {$join
        	->on('r034fun.NumEmp', '=', 'r034cpl.NumEmp')
        	->on('r034fun.TipCol', '=', 'r034cpl.TipCol')
        	->on('r034fun.NumCad', '=', 'r034cpl.NumCad');
    	})
		->whereIn('r034cpl.NumEmp', erp()->CodEmp)
		->where('EmaCom', auth()->user()->email)
		->first(['r034cpl.NumCad']);

		$r044cal = r046ver::join('r044cal', function ($join) {$join
        	->on('r044cal.NumEmp', '=', 'r046ver.NumEmp')
        	->on('r044cal.CodCal', '=', 'r046ver.CodCal');
    	})
    	->whereIn('r046ver.NumEmp', erp()->CodEmp)
		->whereIn('r044cal.TipCal', [11])
		->where('r044cal.SitCal', 'T')
		->where('r044cal.CodCal', $codcal)
		->orderBy('r044cal.CodCal','Desc')
		->first(['r044cal.CodCal','r044cal.DatPag','r044cal.PerRef']);

		$r046vers = r046ver::select(
			'r046ver.CodEve',
			'r046ver.RefEve',
			'r046ver.ValEve',
			'r008evc.TipEve',
			'r008evc.DesEve')

		->join('r044cal', function ($join) {$join
        	->on('r044cal.NumEmp', '=', 'r046ver.NumEmp')
        	->on('r044cal.CodCal', '=', 'r046ver.CodCal');
    	})
 		->join('r008evc', function ($join) {$join
        	->on('r008evc.CodTab', '=', 'r046ver.TabEve')
        	->on('r008evc.CodEve', '=', 'r046ver.CodEve');
    	})
    	->join('r034fun', function ($join) {$join
        	->on('r034fun.NumEmp', '=', 'r046ver.NumEmp')
        	->on('r034fun.TipCol', '=', 'r046ver.TipCol')
        	->on('r034fun.NumCad', '=', 'r046ver.NumCad');
    	})
    	->whereIn('r046ver.NumEmp', erp()->CodEmp)
    	->where('r046ver.CodCal', $r044cal->CodCal)
		->where('r046ver.NumCad', $r034fun->NumCad)
		->whereIn('r044cal.TipCal', [11])
		->where('r044cal.SitCal', 'T')
    	->get();

    	$TotPro=0;
    	$TotDsc=0;
    	$TotOut=0;
    	
    	foreach ($r046vers as $key => $r046ver) {

    		$r046ver->CodEve = str_pad($r046ver->CodEve, 3, '0',STR_PAD_LEFT).' - '.$r046ver->DesEve;

			if ($r046ver->TipEve<=2){
				$TotPro+= $r046ver->ValEve;
				$r046ver->VlrPro = 'R$ '.number_format($r046ver->ValEve, 2, ',', '.');
				$r046ver->VlrDsc = '';
				$r046ver->VlrOut = '';
			}

			if ($r046ver->TipEve==(3)){
				$TotDsc+= $r046ver->ValEve;
				$r046ver->VlrPro = '';
				$r046ver->VlrDsc = 'R$ '.number_format($r046ver->ValEve, 2, ',', '.');
				$r046ver->VlrOut = '';
			}

			if ($r046ver->TipEve==(4)){
				$TotOut+= $r046ver->ValEve;
				$r046ver->VlrPro = '';
				$r046ver->VlrDsc = '';
				$r046ver->VlrOut = 'R$ '.number_format($r046ver->ValEve, 2, ',', '.');
			}
    	}

		$data['series'] = $r046vers->toArray();
		$data['TotCal']['DatPag'] = date('d/m/Y', strtotime($r044cal->DatPag));
		$data['TotCal']['MesAno'] = date('m/Y', strtotime($r044cal->PerRef));
    	$data['TotCal']['TotOut'] = 'R$ '.number_format($TotOut, 2, ',', '.');
		$data['TotCal']['TotPro'] = 'R$ '.number_format($TotPro, 2, ',', '.');
    	$data['TotCal']['TotDsc'] = 'R$ '.number_format($TotDsc, 2, ',', '.');
    	$data['TotCal']['VlrLiq'] = 'R$ '.number_format(($TotPro-$TotDsc), 2, ',', '.');

		return response()->json($data);
	}
	//********************************************************************//
	//
	//VIEW FOLHA DO COLABORDOR
	//
	//********************************************************************//
	public function folha(){
		return view('bam.folha');
	}
	//********************************************************************//
	//
	//HCM CUSTO DA FOLHA
	//
	//********************************************************************//
	public function r046verTotEveDesEve(){

		$CodCal = r046ver::join('r044cal', function ($join) {$join
        	->on('r044cal.NumEmp', '=', 'r046ver.NumEmp')
        	->on('r044cal.CodCal', '=', 'r046ver.CodCal');
    	})
    	->whereIn('r046ver.NumEmp', erp()->CodEmp)
		->where('r044cal.TipCal', 11)
		->where('r044cal.SitCal', 'T')
		->orderBy('r044cal.CodCal','Desc')
		->first(['r044cal.CodCal','r044cal.DatPag','r044cal.PerRef']);

		$r046ver = r046ver::select(
			DB::raw('sum(r046ver.ValEve) AS TotEve'),
			'r008evc.DesEve')

		->join('r044cal', function ($join) {$join
        	->on('r044cal.NumEmp', '=', 'r046ver.NumEmp')
        	->on('r044cal.CodCal', '=', 'r046ver.CodCal');
    	})
 		->join('r008evc', function ($join) {$join
        	->on('r008evc.CodTab', '=', 'r046ver.TabEve')
        	->on('r008evc.CodEve', '=', 'r046ver.CodEve');
    	})
    	->whereIn('r046ver.NumEmp', erp()->CodEmp)
    	->where('r046ver.CodCal', $CodCal->CodCal)
		->where('r044cal.TipCal', 11)
		->where('r044cal.SitCal', 'T')
		->groupBy('r008evc.DesEve')
    	->get();

		$data['series'] = $r046ver;
		$data['DatLog'] = date('d/m/Y', strtotime($CodCal->DatPag));
		$data['TitBam'] = 'HCM | Custo Folha '.date('m/Y', strtotime($CodCal->PerRef));
		$data['SubTxt'] = 'Custo total da Folha';

		return response()->json($data);
	}

    //********************************************************************//
	//
	//COLABORADORES POR SEXO r034funQtdColTipSex
	//
	//********************************************************************//
	public function r034funQtdColTipSex(){
		$r034funs = r034fun::whereIn('r034fun.NumEmp', erp()->CodEmp)
			->whereIn('r034fun.CodFil', erp()->CodFil)
			->where('SitAfa', 1)
			->select('r034fun.TipSex',
			DB::raw('count(NumEmp) AS QtdCol'))
			->groupBy('r034fun.TipSex')
			->get()->toArray();

		$TotCol = 0;
		
		foreach ($r034funs as $k => $r034fun) {
			$TotCol += $r034fun['QtdCol'];
			
			if ($r034fun['TipSex']=='M'){

				$r034funs[$k]['TipSex']='Masculino';
			
			} elseif ($r034fun['TipSex']=='F') {
				
				$r034funs[$k]['TipSex']='Feminino';
			}
		}


		$data['DatLog'] = date('d/m/Y H:i:s');
		$data['TitBam'] = 'HCM | HeadCount - Sexo';
		$data['SubTxt'] = 'Sexo X HeadCount : '. $TotCol.' Colaboradores.';
		$data['series'] = $r034funs;

		return response()->json($data);
	}
	//********************************************************************//
	//
	//PAINEL DASHBOARD | Colaboradores por Local
	//
	//********************************************************************//
	public function r034funNumLocQtdfun(){
		
		$r034funs = r034fun::whereIn('r034fun.NumEmp', erp()->CodEmp)
		->whereIn('r034fun.CodFil', erp()->CodFil)
		->join('r016orn', function ($join) {$join
        	->on('r016orn.NumLoc', '=', 'r034fun.NumLoc')
        	->on('r016orn.TabOrg', '=', 'r034fun.TabOrg');
        })
		->where('SitAfa', 1)
		->select('r016orn.NomLoc', DB::raw('count(r034fun.NumEmp) AS QtdFun'))
		->groupBy('r016orn.NomLoc')
		->orderBy('QtdFun','Desc')
		->get()->toArray();

		$data['DatLog'] = date('d/m/Y H:i:s');
		$data['TitBam'] = 'HCM | HeadCount - Local';
		$data['SubTxt'] = 'Local X HeadCounts';
		$data['series'] = $r034funs;

		return response()->json($data);
	}
	//********************************************************************//
	//
	//PAINEL DASHBOARD | Colaboradores por Posto de Trabalho
	//
	//********************************************************************//
	public function r034funPosTraQtdFun(){
		
		$r034funs = r034fun::whereIn('r034fun.NumEmp', erp()->CodEmp)
		->whereIn('r034fun.CodFil', erp()->CodFil)
		->join('r017pos', function ($join) {$join
        	->on('r017pos.PosTra', '=', 'r034fun.PosTra')
        	->on('r017pos.EstPos', '=', 'r034fun.EstPos');
        })
		->where('SitAfa', 1)
		->select('r017pos.DesRed', DB::raw('count(r034fun.NumEmp) AS QtdFun'))
		->groupBy('r017pos.DesRed')
		->orderBy('QtdFun','Desc')
		->get()->toArray();

		$data['DatLog'] = date('d/m/Y H:i:s');
		$data['TitBam'] = 'HCM | HeadCount - Posto';
		$data['SubTxt'] = 'Posto X HeadCounts';
		$data['series'] = $r034funs;

		return response()->json($data);
	}
	//********************************************************************//
	//
	//PAINEL DASHBOARD | Colaboradores por Centro de Custos
	//
	//********************************************************************//
	public function r034funNomCcuQtdFun(){
		
		$r034funs = r034fun::whereIn('r034fun.NumEmp', erp()->CodEmp)
		->whereIn('r034fun.CodFil', erp()->CodFil)
		->join('r018ccu', function ($join) {$join
        	->on('r018ccu.NumEmp', '=', 'r034fun.NumEmp')
        	->on('r018ccu.CodCcu', '=', 'r034fun.CodCcu');
        })
		->where('SitAfa', 1)
		->select('r018ccu.NomCcu', DB::raw('count(r034fun.NumEmp) AS QtdFun'))
		->groupBy('r018ccu.NomCcu')
		->orderBy('QtdFun','Desc')
		->get()->toArray();

		$data['DatLog'] = date('d/m/Y H:i:s');
		$data['TitBam'] = 'HCM | HeadCount - C.Custo';
		$data['SubTxt'] = 'C.Custo X HeadCounts';
		$data['series'] = $r034funs;

		return response()->json($data);
	}
}