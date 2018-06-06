<?php

namespace App\Http\Controllers\Bam;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Senior\e045pla;
use App\Models\Senior\e650sal;
use DB;

class controladoriaController extends Controller
{	    

	//********************************************************************//
	//
	//PAINEL CONTROLADORIA bam/controladoria
	//
	//********************************************************************//
    
    //********************************************************************//
	//
	//e650sal Contábil das Contas De Receita Grupo 3000
	//
	//********************************************************************//
	public function e650salSalMesCtaRed(){
		
		

		$CtaRed = 3000;

		$AbrCta = e045pla::where('codEmp', erp()->CodEmp)
		->where('CtaRed',$CtaRed)
		->value('AbrCta');

		$lastData = e650sal::whereIn('e650sal.CodEmp', erp()->CodEmp)->max('MesAno');
		$year = substr($lastData,0,4);
    	
    	$x = $year-4;
    	
    	$i=0;
		while ($year>=$x) {

			$MMs = Meses();
		
			foreach ($MMs as $MM){


				$yearMMdd = $year.'-'.$MM[1].'-01';

				$e650sal = e650sal::select(DB::raw('Sum(CreMes) as CreMes'))

				->whereIn('e650sal.CodEmp', erp()->CodEmp)
				->whereIn('e650sal.CodFil', erp()->CodFil)
				->whereDate('e650sal.MesAno', $yearMMdd)
				->where('e650sal.AnaSin','S')
				->where('e650sal.CtaRed', $CtaRed)
				->first();

				$FatAno[$i][]=isset($e650sal->CreMes)?abs($e650sal->CreMes):0;
				$e650sals[]=$e650sal;
			}
			$legend[]=(string)$year;
	
			$i++;
		$year--;
		}

		$data['legend']	= $legend;
		$data['xAxis']	= $MMs;
		$data['series'] = $FatAno;
		$data['AbrCta'] = $AbrCta;
		$data['e650salLog'] = $lastData;//date('d-m-Y H:i:s');
		$data['TitBam'] = 'Monitoramento do Faturamento';
		$data['SubTxt'] = 'Comparativo Faturamento Anual';

		return response()->json($data);
	}
}
