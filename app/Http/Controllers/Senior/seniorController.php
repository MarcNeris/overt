<?php

namespace App\Http\Controllers\Senior;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Senior\e070emp;
use App\Models\Senior\e070fil;
use App\Models\Senior\e001tns;
use App\Models\Senior\e085cli;
use App\Models\Senior\e085hcl;
use App\Models\Senior\e140nfv;
use App\Models\Senior\e140ide;
use App\Models\Senior\e140ipv;
use App\Models\Senior\e140isv;
use App\Models\Senior\e501mcp;
use App\Models\Senior\e600mes;
use App\Models\Senior\e650sal;
use App\Models\Senior\e045pla;
use App\Models\Senior\e301tcr;
use App\Models\Senior\e501tcp;
use App\Models\Senior\e600mcc;
use App\Models\Senior\e640lct;
use App\Models\Senior\e640lot;
use App\Models\Senior\e605ext;
use App\Models\Senior\erpemp000;
use App\Models\Senior\erptns000;
use App\Models\regempusu;
use App\Models\bamprd000;
use DB;

class seniorController extends Controller
{	
	

	//********************************************************************//
	//
	//RETORNA VIEW PARA AIVAÇÃO DAS EMPRESAS E FILIAIS SENIOR
	//
	//********************************************************************//
	public function v070emp(){

		$e070emps = e070emp::select('CodEmp','SigEmp','LogEmp')
		->get()->toArray();

		$empresasSenior='';
		foreach ($e070emps as $e070emp) {
			$empresasSenior = $empresasSenior.$e070emp['CodEmp'].'-'.$e070emp['SigEmp'].','; 
			
		}

		return view('senior.v070emp', compact('empresasSenior'));
	}
	//********************************************************************//
	//
	//ATIVAR EMPRESAS
	//
	//********************************************************************//
	public function ativar_erpemp000($id){//CODUSU+CODEMP+CODFIL

		$erpemp000 = erpemp000::find($id);

		if ($erpemp000->SitEmp==0){
			
			$erpemp000->SitEmp=1;
			$erpemp000->save();
		
		} else {
		
			$erpemp000->SitEmp=0;
			$erpemp000->save();
		
		}

		return $erpemp000->SitEmp;
	}
	//********************************************************************//
	//
	//GESTAO DE TNS DA EMPRESA
	//
	//********************************************************************//
	public function e001tns(erptns000 $erptns000){

		//dd(uniqid());

		$e001tnss = e001tns::select('CodEmp','CodTns','DesTns','LisMod','ComNop','VenFat')
		->where('SitTns', 'A')
		->where('LisMod', 'VEF')
		->where('VenFat', 'S')
		->get()->toArray();

		foreach ($e001tnss as $e001tns ) {

			try {
            	$iderptns000 = $erptns000->new_erptns000($e001tns);
                                    
        	} catch (\PDOException $e) {

        	}	
		}
	}
	//********************************************************************//
	//
	//CARREGAR EMPRESAS DO ERP NO BAM
	//
	//********************************************************************//
	public function e070emp(erpemp000 $erpemp000){

		$RegFed = regempusu::where('users0001s.user_id', auth()->user()->id)
		->where('users0001s.SitUsu', 1)
		->join('users0001s', 'regempusus.idRegEnt','=','users0001s.idRegEnt')
		->join('regemp000s', 'regempusus.idRegEmp','=','regemp000s.id')
		->join('regpsa000s', 'regemp000s.idRegPsa','=','regpsa000s.id')
		->value('RegFed');

		$CodEmp = e070emp::select('e070fil.CodEmp')
		->join('e070fil', function ($join) {$join
        	->on('e070emp.CodEmp', '=', 'e070fil.CodEmp');
        })
        ->where('NumCgc', $RegFed)
		->value('CodEmp');


		$e070fils = e070emp::select('SigEmp','e070fil.CodEmp','SigFil','CodFil','NumCgc')
		->join('e070fil', function ($join) {$join
        	->on('e070emp.CodEmp', '=', 'e070fil.CodEmp');
        })
        ->where('e070fil.CodEmp', $CodEmp)
		->get()->toArray();

		foreach ($e070fils as $e070fil ) {

			$e070fil['NomSis']='Sapiens';

			try {
            
            	$iderpemp000 = $erpemp000->new_erpemp000($e070fil);
                                    
        	} catch (\PDOException $e) {

        	}	
		}

		$erpemp000 = erpemp000
		::select('id','CodEmp','SigEmp','CodFil','SigFil','SitEmp')
		->where('user_id', auth()->user()->id)
		->get()
		->toArray();
		return datatables()->of($erpemp000)->toJson();
	}

	//********************************************************************//
	//
	//Cadastra e Retorna View com Empresas e Filiais Sapiens
	//
	//********************************************************************//
	public function e070fil(erpemp000 $erpemp000){
		
		$e070fils = e070emp::select('SigEmp','e070fil.CodEmp','SigFil','CodFil','NumCgc')
		->join('e070fil', function ($join) {$join
        	->on('e070emp.CodEmp', '=', 'e070fil.CodEmp');
        })
		->get()->toArray();


	// foreach ($e070fils as $e070fil) {
	// dd($e070fil);

	// 	$e070fil['NomSis']='Sapiens';

	// 	try {
	    
	//           	$iderpemp000 = $erpemp000->new_erpemp000($e070fil);
	                            
	//       	} catch (\PDOException $e) {
	//       	}	
	// }
	// return view('senior.v070emp');
	}
	//
	//
	// Retorna View v140ipv | senior/v140ipv
	//
	//
	public function v140ipv(){

		return view('bam.v140ipv');
	}
	











	public function faturamento(){


		//$e140ipv_count = e140ipv::count();
		//$e140ipv_max = e140ipv::max('VlrLiq');
		//$e140ipv_avg = e140ipv::where('CodEmp', 1)->avg('VlrLiq'); FORMAT(d, 'yyyy-MM-dd')

		$faturamento = e140nfv::select(
				 DB::raw("FORMAT(e140nfv.DatEmi, 'dd/MM/yyyy') as DatEmi")
				//'e140nfv.DatEmi'
				,DB::raw("sum(e140ipv.VlrLiq) as VlrLiq")
			)
			->where('e140nfv.SitNfv', '=', 2)
			->whereIn('e140ipv.CodEmp', ['1'])
			->whereIn('e140nfv.TnsPro', ['6101'])
			->groupBy('e140nfv.DatEmi')
			->join('e140ipv', 'e140ipv.NumNfv','=','e140nfv.NumNfv')
			->orderBy('e140nfv.DatEmi','Asc')
	        ->take(15)->get();



		return  response()->json($faturamento);
	}
	//********************************************************************//
	//
	//Retorna Tabela de Clientes
	//
	//********************************************************************//
	public function get_e085cli(){
		
		$e085cli = e085cli::join('e085hcl','e085hcl.CodCli','e085cli.CodCli')
		->whereIn('e085hcl.CodEmp', erp()->CodEmp)
		->whereIn('e085hcl.CodEmp', erp()->CodFil)
		->get(['e085cli.CodCli','NomCli','ApeCli','CgcCpf','EstCob','CidCob','BaiCob','CepCob','FonCli','IntNet']);
		
		return datatables()->of($e085cli)->toJson();
	}

	public function clientes(){
		return view('bam.clientes');
	}
	//********************************************************************//
	//
	//RETORNA HISTÓRICO DE CLIENTES
	//
	//********************************************************************//
	public function get_e085hcl($CodCli){
			
		$e085hcl = e085hcl::whereIn('CodEmp', erp()->CodEmp)
		->whereIn('e085hcl.CodEmp', erp()->CodFil)
		->where('CodCli', $CodCli)
		->first(['CodCli','CatCli','LimApr','VlrLim','VlrMac','SalCre','MedAtr','MaiAtr','PrzMrt','DatUpg','VlrUpg','DatUfa','VlrUfa','DatUpe','VlrUpe']);
		
		return response()->json($e085hcl);
	}
    //********************************************************************//
    //
    //Consome WebServices do Sapiens
    //
    //********************************************************************//
    public function WebService()
    {
    	try {
		    $opts = array(
		        'http' => array(
		            'user_agent' => 'PHPSoapClient'
		        )
		    );
		    $context = stream_context_create($opts);

		    $wsdlUrl = 'http://marcneris:8080/g5-senior-services/sapiens_Synccom_senior_g5_co_mfi_cre_titulos?wsdl';
		    
		    $soapClientOptions = array(
		        'stream_context' => $context,
		        'cache_wsdl' => WSDL_CACHE_NONE
		    );

		    //$client = new \SoapClient($wsdlUrl, $soapClientOptions);

		    //dd($client->__getFunctions());
		    //dd($client->__getTypes());

		    $arguments = array(
		        'user'=>'webservice',
		    	'password'=>'123456',
		    	//'encryption'=>0,
		    	//'parameters' => [
		    	//	'codCli' => '1',
		    	//	'codEmp' => '0002'
		    	//]
		    );

		    //$response = $client->__soapCall('ConsultarTitulosCR', $arguments);

		    //dd($response);


		    $result = $client->ConsultarTitulosCR('webservice', '123456', 0, $arguments);
		    dd($result);

		}
		catch(Exception $e) {
		    echo $e->getMessage();
		}
	}
}