<?php

namespace App\Http\Controllers\Bam;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Senior\e140nfv;
use App\Models\Senior\e140ipv;
use App\Models\Senior\e085cli;
use App\Models\Senior\erpemp000;//Corrigir
use DB;


class faturamentoController extends Controller
{
	//********************************************************************//
	//
	//e140nfv Saldo Mensal por Codigo do Cliente
	//
	//********************************************************************//
	public function maps(){
		return view('bam.maps');
	}

    //********************************************************************//
	//
	//e140nfv Saldo Mensal por Codigo do Cliente
	//
	//********************************************************************//
	public function e140nfvSalMesCodCli(){

		$lastData = e140nfv::whereIn('e140nfv.CodEmp', erp()->CodEmp)
			->whereIn('e140nfv.CodFil', erp()->CodFil)
			->max('DatEmi');

		$e140nfv = e140nfv::select(
			'e085cli.ApeCli'
			,DB::raw('sum(VlrLiq) AS VlrLiq'))
			->join('e085cli', 'e085cli.CodCli','=','e140nfv.CodCli')
			->whereIn('e140nfv.CodEmp', erp()->CodEmp)
			->whereIn('e140nfv.CodFil', erp()->CodFil)
			->whereIn('SitNfv', [2,4,5,6])
			//->where('VlrLiq','>=', 10000)
			->where('e085cli.SitCli', 'A')
			->groupBy('e085cli.ApeCli')
			->orderBy('VlrLiq','Desc')
			->take(10)
			->get();

			$data['series'] = $e140nfv;
			$data['e140nfvSal'] = $lastData;//date('d-m-Y H:i:s');
			$data['TitBam'] = 'Monitoramento de Faturamento por Clientes';
			$data['SubTxt'] = 'Top 10';

		return response()->json($data);
	}
	//********************************************************************//
	//
	// Top 7 Itens de Faturamento agrupado por Produto e Data de Saída tabela e140ipv
	//
	//********************************************************************//
	public function e140ipv(){
		

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

		$CodEmp = array_unique($CodEmp);
		$CodFil = array_unique($CodFil);


		$CodTns = ['5101','6101'];

		$maxEnt = e140nfv::whereIn('e140nfv.CodEmp', $CodEmp)
		->whereIn('e140nfv.CodFil', $CodFil)
		->max('DatSai');
		$maxEnt = sumDay($maxEnt, -5);

	
		$e140ipvs = e140ipv::select(
		 DB::raw("FORMAT(e140nfv.DatSai, 'dd/MM') as DatSai")
		,'CplIpv'
		,DB::raw('SUM(e140ipv.VlrLiq) as VlrLiq')
		)
		->join('e140nfv', function ($join) {$join
        ->on('e140ipv.NumNfv', '=', 'e140nfv.NumNfv')
        ->on('e140ipv.CodEmp', '=', 'e140nfv.CodEmp')
        ->on('e140ipv.CodFil', '=', 'e140nfv.CodFil');
        })
		->where('e140ipv.CodPro','<>','')
		->whereIn('e140nfv.CodEmp', $CodEmp)
		->whereIn('e140nfv.CodFil', $CodFil)
		->whereIn('e140nfv.NopPro', $CodTns)
		->whereIn('e140nfv.SitNfv', ['1','2'])
		->whereDate('e140nfv.DatSai','>', $maxEnt)
		->groupBy('DatSai','CplIpv')
		->orderBy('e140nfv.DatSai','DESC')
		->take(5)
		->get();

		$i=0;

		foreach ($e140ipvs as $e140ipv){
			$DatSai = $e140ipv->DatSai;
			$legend[] = $e140ipv->CplIpv;
            $dias[] = $e140ipv->DatSai;
			$data[$DatSai][$i]['CplIpv'] = $e140ipv->CplIpv;
			$data[$DatSai][$i]['VlrLiq'] = $e140ipv->VlrLiq;
			$data[$DatSai][$i]['DatSai'] = $DatSai;
			$i++;
		}
			
		$legends = array_values(array_unique($legend));
        $datas = array_values($data);
        $dias = array_values(array_unique($dias));

		foreach ($datas as $keydata => $data) {
            foreach ($data as $key => $value) {
                $i=0;
                while (isset($legends[$i])) {
                    if($legends[$i]==$value['CplIpv']){
                        $dados[$i]['data'][$keydata]=$value['VlrLiq'];
                        $dados[$i]['name']=$value['CplIpv'];
                        $type='line';
                        $dados[$i]['type']=$type;
                    }
                    if(!isset($dados[$i]['data'][$keydata]))$dados[$i]['data'][$keydata]=0;
                   $i++;
                }
            }    
        }
        
	    $dataBam['legend']=$legends;
        $dataBam['dias']=$dias;
        $dataBam['dados']=$dados;

		return response()->json($dataBam);
	}

		public function e140nfv($CodEmp, $CodFil, $CodTns){
		//*
		// Faturamento 7 dias agrupado por Data de Saída tabela e140nfv
		//*
		$CodEmp = explode(',', $CodEmp);
		$CodFil = explode(',', $CodFil);
		$CodTns = explode(',', $CodTns);
			

		$e140nfv = e140nfv
		::select(
		 DB::raw("FORMAT(e140nfv.DatSai, 'dd/MM/yyyy') as DatSai")
		,DB::raw('SUM(e140nfv.VlrLiq) as VlrLiq')
		)
		->groupBy('DatSai')
		->whereIn('e140nfv.CodEmp', $CodEmp)
		->whereIn('e140nfv.CodFil', $CodFil)
		->whereIn('e140nfv.NopPro', $CodTns)
		->where('e140nfv.SitNfv','2')
		->orderBy('e140nfv.DatSai','Dsc')
		->take(7)
		->get()->toArray();

		return response()->json($e140nfv);
	}
}
