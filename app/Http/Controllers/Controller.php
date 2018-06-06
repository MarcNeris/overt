<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Mail\overtMail;
use Session;
use Mail;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function perfil(){

    	//$email=['to'=>'Marcelo Neris','from'=>'overt'];

        // Mail::send('crm.mail',['email' => $email], function ($message) {
        //     $message->from('us@example.com', 'Mail::Send');
        //     $message->to('overt@overt.com.br')->cc('marceloneris@hotmail.com');
        // });




    	$data=['NomFta'=>Session::get('NomFta')];
    	$email = Mail::to('overt@overt.com.br')->send(new overtMail($data));

	    dd($email);

        return view('crm.conta');
    }
}
