<?php

namespace App\Http\Controllers\Hcm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\hcmcol000;
use Session;
use App\Jobs\r034funUpload;
use App\Http\Controllers\FB;

class syncController extends Controller
{
	public static function syncEmployees(){

		$employees=FB::FB('employees');

		foreach ($employees as $key => $user) {

			$hcmcol000=hcmcol000::select('id')
			->where('NumCgc',$user['NumCgc'])
			->where('NumCpf',$key)
			->first();
			$upd_hcmcol000 = hcmcol000::find($hcmcol000->id);
			$upd_hcmcol000->UsuUid=$user['UsuUid'];
			$upd_hcmcol000->NomUsu=$user['NomUsu'];
			$upd_hcmcol000->EmlUsu=$user['EmlUsu'];
			$upd_hcmcol000->EmlVrf=$user['EmlVrf'];
			$upd_hcmcol000->save();
		}
	}


    public static function syncEmployers(){

		$get_employers = FB::FB('employers/12345678010158/');

		foreach ($get_employers as $cpf => $employee) {
			$new_hcmcol000 = hcmcol000::new_hcmcol000($employee);
		}
	}
}
