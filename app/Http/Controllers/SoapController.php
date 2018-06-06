<?php

namespace App\Http\Controllers;

use Artisaninweb\SoapWrapper\SoapWrapper;
use App\Soap\Request\GetConversionAmount;
use App\Soap\Response\GetConversionAmountResponse;

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
   * Use the SoapWrapper
   */
  public function showa()
  {
    $this->soapWrapper->add('Currency', function ($service) {
      $service
        ->wsdl('http://currencyconverter.kowabunga.net/converter.asmx?WSDL')
        ->trace(true)
        ->classmap([
          GetConversionAmount::class,
          GetConversionAmountResponse::class,
        ]);
    });

    $response = $this->soapWrapper->call('Currency.GetConversionAmount', [
      'parameters' => [
          'CurrencyFrom' => 'EUR',
          'CurrencyTo'   => 'BRL',
          'RateDate'     => '2018-04-22T00:00:00',
          'Amount'       => '1',
        ]
    ]);
 
    dd($response);

    $response = $this->soapWrapper->call('Currency.GetConversionAmount', [
      new GetConversionAmount('USD', 'BRL', '2018-04-22', '1')
    ]);

    print_r($response);
    exit;
  }



  public function show()
  { 

    $this->soapWrapper->add('BCB', function ($service) {
      $service->wsdl('https://www3.bcb.gov.br/wssgs/services/FachadaWSSGS?wsdl');
    });

    $response = $this->soapWrapper->call('BCB.getValor',$parameters=['4','13/04/2018']);
 
    dd($response);

  }

  public function getCep($cep){

    $endereco='http://api.postmon.com.br/v1/cep/'$cep;

    retun $cep;
  }

}