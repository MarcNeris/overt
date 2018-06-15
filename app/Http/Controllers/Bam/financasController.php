<?php

namespace App\Http\Controllers\Bam;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Senior\e600mcc;
use App\Models\Senior\e600mes;
use App\Models\Senior\e501mcp;
use App\Models\Senior\e501tcp;
use App\Models\Senior\e301tcr;
use DB;

class financasController extends Controller
{
    //********************************************************************//
	//
	//PAINEL FINANCEIRO bam/financeiro
	//
	//********************************************************************//
	//********************************************************************//
	//
	//MONITORAMENTO SALDO DA CONTA INTERNA
	//
	//********************************************************************//
	
	public function e600mesSalMesNumCco(){

		$NumCcos =  e600mes::whereIn('e600mes.CodEmp', erp()->CodEmp)
		->join('e600cco', 'e600cco.NumCco','=','e600mes.NumCco')
		->distinct('e600cco.NumCco')
		->get(['e600cco.NumCco']);

		$series=[];
		foreach ($NumCcos as $k => $NumCco) {
			$SalMes = e600mes::join('e600cco', 'e600cco.NumCco','=','e600mes.NumCco')
		    ->whereIn('e600mes.CodEmp', erp()->CodEmp)
			->where('e600mes.NumCco', $NumCco->NumCco)
			->where('SitCco', 'A')
			->orderBy('DatCmp','Desc')
			->value('SalMes');
			$series[$k]['NumCco'] = $NumCco->NumCco;
			$series[$k]['SalMes'] = $SalMes;
		}

		$DatLog = e600mcc::whereIn('e600mcc.CodEmp', erp()->CodEmp)->max('DatMov');
	
		$data['series'] = $series;
		$data['DatLog'] = 'Último Movimento '.date('d/m/Y H:i:s',strtotime($DatLog));
		$data['TitBam'] = 'Monitoramento das Contas Internas';
		$data['SubTxt'] = 'Saldo das Contas Internas';
		
		return response()->json($data);
	}
	//********************************************************************//
	//
	//TOP 10 CONTAS A PAGAR EM ABERTO POR TIPO DE TÍTULO
	//
	//********************************************************************//
	public function e501mcpVlrAbeCodTpt(){

		$e501mcp = e501mcp::select('DesTpt'
		, DB::Raw('Sum(VlrAbe) as VlrAbe'))
		->join('e002tpt', 'e501mcp.CodTpt','=','e002tpt.CodTpt')
		->whereIn('CodEmp', erp()->CodEmp)
		->whereIn('CodFil', erp()->CodFil)
		//->take(5)
		->groupBy('DesTpt')
		->orderBy('VlrAbe', 'Desc')
		->where('VlrAbe','>',0)
		->get();

		//number_format($FatMes->FatMes, 2, '.', '')
		$data['DatLog'] = date('d-m-Y H:i:s');
		$data['TitBam'] = 'Monitoramento CPA por Tipo de Título';
		$data['SubTxt'] = 'Top 5 Contas a Pagar';
		$data['series'] = $e501mcp;

		return response()->json($data);
	}
	//********************************************************************//
	//
	//e301tcr Títulos Vencidos Por Cliente
	//
	//********************************************************************//
	public function e301tcrVlrAbeCodCli(){
		
		$e301tcr = e301tcr::select(
			'e085cli.ApeCli',
			DB::raw('sum(VlrAbe) AS VlrAbe')
			)
			->join('e002tpt', 'e002tpt.CodTpt','=','e301tcr.CodTpt')
			->join('e085cli', 'e085cli.CodCli','=','e301tcr.CodCli')
			//->where('e301tcr.CodCli', 1)
			->whereDate('e301tcr.VctPro','<=', date("Y-m-d"))
			//->whereIn('e301tcr.SitTit', ['AB','CA','CO','LO','LQ','LS'])
			->where('e301tcr.VlrAbe','>', 0)
			//->whereIn('e002tpt.AplTpt', ['A','R'])
			->whereIn('e002tpt.RecSom', ['D','O'])
			//->whereIn('e301tcr.CodTns', ['90300','90301','90305','90330','90334'])
			->whereIn('e301tcr.CodEmp', erp()->CodEmp)
			->whereIn('e301tcr.CodFil', erp()->CodFil)
			->groupBy('e085cli.ApeCli')
			->orderBy('VlrAbe','Desc')
			//->take(10)
			->get()->toArray();

			$data['series'] = $e301tcr;
			$data['DatLog'] = date('d-m-Y H:i:s');
			$data['TitBam'] = 'Monitoramento CRE';
			$data['SubTxt'] = 'Títulos Vencidos Por Cliente';

			//dd($data);

		return response()->json($data);
	}
	//********************************************************************//
	//
	//e301tcr Títulos a Vencer Por Cliente
	//
	//********************************************************************//
	public function e301tcrVlrTitCodCli(){
		
		$e301tcr = e301tcr::select(
			'e085cli.ApeCli',
			DB::raw('sum(VlrAbe) AS VlrTit')
			)
			->join('e002tpt', 'e002tpt.CodTpt','=','e301tcr.CodTpt')
			->join('e085cli', 'e085cli.CodCli','=','e301tcr.CodCli')
			//->where('e301tcr.CodCli', 1)
			->whereDate('e301tcr.VctPro','>=', date("Y-m-d"))
			//->whereIn('e301tcr.SitTit', ['AB','CA','CO','LO','LQ','LS'])
			->where('e301tcr.VlrAbe','>', 0)
			//->whereIn('e002tpt.AplTpt', ['A','R'])
			->whereIn('e002tpt.RecSom', ['D','O'])
			//->whereIn('e301tcr.CodTns', ['90300','90301','90305','90330','90334'])
			->whereIn('e301tcr.CodEmp', erp()->CodEmp)
			->whereIn('e301tcr.CodFil', erp()->CodFil)
			->groupBy('e085cli.ApeCli')
			->orderBy('VlrTit','Desc')
			//->take(10)
			->get()->toArray();

			$data['series'] = $e301tcr;
			$data['DatLog'] = date('d-m-Y H:i:s');
			$data['TitBam'] = 'Monitoramento CRE';
			$data['SubTxt'] = 'Títulos a Vencer Por Cliente';

			//dd($data);

		return response()->json($data);
	}
	//********************************************************************//
	//
	//e501tcp Títulos Vencidos Por Fornecedor
	//
	//********************************************************************//
	public function e501tcpVlrAbeCodFor(){
		
		$e501tcp = e501tcp::select(
			'e095for.ApeFor',
			DB::raw('sum(VlrAbe) AS VlrAbe')
			)
			->join('e002tpt', 'e002tpt.CodTpt','=','e501tcp.CodTpt')
			->join('e095for', 'e095for.CodFor','=','e501tcp.CodFor')
			//->where('e501tcp.CodFor', 1)
			->whereDate('e501tcp.VctPro','<=', date("Y-m-d"))
			//->whereIn('e501tcp.SitTit', ['AB','CA','CO','LO','LQ','LS'])
			->where('e501tcp.VlrAbe','>', 0)
			//->whereIn('e002tpt.AplTpt', ['A','R'])
			->whereIn('e002tpt.RecSom', ['D','O'])
			//->whereIn('e501tcp.CodTns', ['90300','90301','90305','90330','90334'])
			->whereIn('e501tcp.CodEmp', erp()->CodEmp)
			->whereIn('e501tcp.CodFil', erp()->CodFil)
			->groupBy('e095for.ApeFor')
			->orderBy('VlrAbe','Desc')
			//->take(10)
			->get()->toArray();

			$data['series'] = $e501tcp;
			$data['DatLog'] = date('d-m-Y H:i:s');
			$data['TitBam'] = 'Monitoramento CPA Vencidos';
			$data['SubTxt'] = 'Títulos Vencidos Por Fornecedor';

			//dd($data);

		return response()->json($data);
	}
	//********************************************************************//
	//
	//e501tcp Títulos a Vencer Por Fornecedor
	//
	//********************************************************************//
	public function e501tcpVlrTitCodFor(){
				
		$e501tcp = e501tcp::select(
			'e095for.ApeFor',
			DB::raw('sum(VlrAbe) AS VlrTit')
			)
			->join('e002tpt', 'e002tpt.CodTpt','=','e501tcp.CodTpt')
			->join('e095for', 'e095for.CodFor','=','e501tcp.CodFor')
			//->where('e501tcp.CodFor', 1)
			->whereDate('e501tcp.VctPro','>=', date("Y-m-d"))
			//->whereIn('e501tcp.SitTit', ['AB','CA','CO','LO','LQ','LS'])
			->where('e501tcp.VlrAbe','>', 0)
			//->whereIn('e002tpt.AplTpt', ['A','R'])
			->whereIn('e002tpt.RecSom', ['D','O'])
			//->whereIn('e501tcp.CodTns', ['90300','90301','90305','90330','90334'])
			->whereIn('e501tcp.CodEmp', erp()->CodEmp)
			->whereIn('e501tcp.CodFil', erp()->CodFil)
			->groupBy('e095for.ApeFor')
			->orderBy('VlrTit','Desc')
			//->take(10)
			->get()->toArray();

			$data['series'] = $e501tcp;
			$data['DatLog'] = date('d-m-Y H:i:s');
			$data['TitBam'] = 'Monitoramento CPA';
			$data['SubTxt'] = 'Títulos a Vencer Por Fornecedor';

		return response()->json($data);
	}
	//********************************************************************//
	//
	//TOP 10 CONTAS A PAGAR POR FORNECEDOR EM ABERTO POR TIPO DE TÍTULO
	//
	//********************************************************************//
	public function e501mcpVlrAbeCodFor()
	{

		//$CodTns = ['5101','6101'];

		$e501mcp = e501mcp::select(
		//'e501mcp.CodTpt'
		//,'VctPro'
		'NomFor'
		, DB::Raw('Sum(VlrAbe) as VlrAbe')
		)//'NumTit','CodTns','DatMov','VctPro','VlrMov','VlrLiq','VlrAbe')
		->join('e095For', 'e501mcp.CodFor','=','e095For.CodFor')
		->whereIn('CodEmp', erp()->CodEmp)
		->whereIn('CodFil', erp()->CodFil)
		//->whereIn('CodTns', $CodTns)
		->take(10)
		->groupBy('NomFor')//,'e501mcp.CodTpt')//,'e501mcp.VctPro')
		->orderBy('VlrAbe', 'Desc')
		->where('VlrAbe','>',0)
		->get();
		
		return response()->json($e501mcp);
	}
}
