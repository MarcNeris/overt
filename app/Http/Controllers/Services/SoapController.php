<?php

namespace App\Http\Controllers\Services;

use Artisaninweb\SoapWrapper\SoapWrapper;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Models\soapsrv00;
use App\Models\regend000;
use App\Models\regpsa000;
use App\Models\regcli000;
use Session;
use DB;

class SoapController
{
  /**
   * @var SoapWrapper
   */
  protected $soapWrapper;

  /**
   * SoapController constructor.
   *
   * @param SoapWrapper $soapWrapper
   */
  public function __construct(SoapWrapper $soapWrapper)
  {
    $this->soapWrapper = $soapWrapper;
  }

  /**
   * CONVERSAO DE MOEDAS
  **/
  public function getDollar()
  {
    $this->soapWrapper->add('Currency', function ($service) {
      $service
        ->wsdl('http://currencyconverter.kowabunga.net/converter.asmx?WSDL')
        ->trace(true);
    });


    //dd(date('Y-m-d').'T'.date('H:i:s'));


    $response = $this->soapWrapper->call('Currency.GetConversionAmount', [
      'parameters' => [
          'RateDate'     => date('Y-m-d').'T'.date('H:i:s'),//'2018-04-26T00:00:00',
          'CurrencyFrom' => 'EUR',
          'CurrencyTo'   => 'BRL',
          'Amount'       => '1',
        ]
    ]);
 
    dd($response);
  }


  /**
   * COTACOES BCB
  **/

  public function getBCB($BCB)
  { 

    $this->soapWrapper->add('BCB', function ($service) {
      $service->wsdl('https://www3.bcb.gov.br/wssgs/services/FachadaWSSGS?wsdl');
    });

    $response = $this->soapWrapper->call('BCB.getValor',$parameters=[$BCB,'25/04/2018']);
 
    dd($response);

  }

  public function soapService(Request $Request)
  {

     //DB::beginTransaction();

        $soapsrv00 = new soapsrv00;
        $soapsrv00['idUsuReg'] = auth()->user()->id;
        $soapsrv00['idPrpReg'] = auth()->user()->id;
        $soapsrv00['idUsuEdt'] = auth()->user()->id;
        $soapsrv00['idRegEnt'] = Session::get('idRegEnt');
        $soapsrv00['idRegEmp'] = Session::get('idRegEmp');
        $soapsrv00['SitReg'] = 1;
        $soapsrv00['SitSrv'] = 1;
        $soapsrv00['NomSrv'] = Input::get('NomSrv');
        $soapsrv00['EndSrv'] = Input::get('EndSrv');
        $soapsrv00['DscSrv'] = Input::get('DscSrv');
        $soapsrv00->save();

        ini_set("soap.wsdl_cache_enabled", "0");
        $Services = new \SoapClient(Input::get('EndSrv'));
        $Functions = $Services->__getFunctions();

        dd($Functions);


  }

  public function soapServices()
  {

    return view('crm.soapServices');
  }


  public function getSenior($service, 
    regpsa000 $regpsa000,
    regend000 $regend000,
    regcli000 $regcli000
    )
  { 

    //dd($service);

    

    ini_set("soap.wsdl_cache_enabled", "0");



    $SeniorService = new \SoapClient('http://appserver2:8080/g5-senior-services/sapiens_Synccom_senior_g5_co_cad_clientes?wsdl');
    
    $parameters= [
      'codEmp'=>'2',
      'codFil'=>'1',
      'identificadorSistema'=>'SENIOR',
      'tipoIntegracao' =>'T',
      'quantidadeRegistros' =>'50'
    ];

    $get_results = $SeniorService->Exportar('senior.sistemas', 'j31m362015', 0, $parameters);

    dd($get_results);

    $results=$get_results->cliente;

    

    if(!is_array($results)){
      $clientes[0]=$results;
    } else{
      $clientes=$results;
    }

      foreach ($clientes as $cliente) {
        
        $data['idRegEnt'] = Session::get('idRegEnt');
        $data['idRegEmp'] = Session::get('idRegEmp');

        $data['RegFed']=$cliente->cgcCpf;
        $data['RegEst']=$cliente->insEst;
        $data['RegMun']=$cliente->insMun;
        $data['NomPsa']=$cliente->nomCli;
        $data['NomFta']=$cliente->apeCli;
        $data['DatReg']=$cliente->datCad;
        $data['CodMun']=0;

        $data['CepEnd']=$cliente->cepCli;
        $data['NomEnd']=$cliente->endCli;
        $data['NumEnd']=str_limit($cliente->nenCli,17);
        $data['CplEnd']=$cliente->cplEnd;
        $data['BroEnd']=$cliente->baiCli;
 
        $data['idRegPsa']=1;//$idRegPsa;
        $data['SitReg']=2;//Importado Senior
        $data['SitCli']=1;
        $data['CapEmp']=0;
        $data['NatJur']=0;
        $data['CodCne']=0;
        $data['CodErp']=$cliente->codCli;
        DB::beginTransaction();

        $idRegPsa=$regpsa000->new_regpsa000($data);
        $data['idRegPsa']=$idRegPsa;
        $idRegEnd=$regend000->new_regend000($data);

        $idRegCli=$regcli000->new_regcli000($data);

        if($regpsa000&&$regend000&&$regcli000){
          $response = DB::commit();
        }
      }
      echo('sucesso!');
      dd($clientes);
    }

}