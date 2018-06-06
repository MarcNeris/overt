<?php

namespace App\Http\Controllers\Services;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Artesaos\LinkedIn\LinkedinServiceProvider;
use Artesaos\LinkedIn\Facades\LinkedIn;
use Session;

class ServiceController extends Controller
{
  	//Buscar CEP
  	public function getCep($cep)
  	{

    	$endereco = file_get_contents('https://viacep.com.br/ws/'.$cep.'/json/');
      //'http://api.postmon.com.br/v1/cep/'.$cep);

      //https://viacep.com.br/ws/$cep/json/;

    	return $endereco;
  	}


  	//Buscar CNPJ
  	public function getCnpj($cnpj)
  	{

    	$empresa = file_get_contents('https://www.receitaws.com.br/v1/cnpj/'.$cnpj);
        
        return $empresa; 
  	}



  	//Buscar LinkedIn
  	public function getLinkedIn(){


//            $url = LinkedIn::getLoginUrl();
// echo "<a href='$url'>Login with LinkedIn</a>";
// exit();






//dd($url);


        //$url = LinkedIn::get('v1/people/~:(firstName,lastName)');
        //dd($url);


        $xxx=LinkedIn::get('v1/people/~:(id,firstName,lastName)');

 dd($xxx);

///Postando no Linkded In
        $options = ['json'=>
             [
                'comment' => 'Senior, Tecnologia para Gestão',
                'visibility' => [
                       'code' => 'anyone'
                ]
             ]
        ];

        $xxx=LinkedIn::post('v1/people/~/shares', $options);


       
//logando no linkedin
     

    


        dd($url);
    		
    }


}
