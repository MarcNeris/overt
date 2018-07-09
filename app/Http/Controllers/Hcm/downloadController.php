<?php

namespace App\Http\Controllers\Hcm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FB;
use App\Models\hcmcol000;

class downloadController extends Controller
{
    
    public static function updEmployees(){

	$employees=FB::FB('employers/06004860000180/');

		if($employees){

			foreach ($employees as $key => $user) {

				$hcmcol000=hcmcol000::select('id')
				->where('NumCgc', $user['NumCgc'])
				->where('NumCpf', $key)
				->first();

				if($hcmcol000){
					$upd_hcmcol000 = hcmcol000::find($hcmcol000->id);
					$upd_hcmcol000->UsuUid=$user['UsuUid'];
					$upd_hcmcol000->NomUsu=$user['NomUsu'];
					$upd_hcmcol000->EmlUsu=$user['EmlUsu'];
					$upd_hcmcol000->EmlVrf=$user['EmlVrf'];
					$upd_hcmcol000->save();
				}
			}
		}
	}



    public static function getEmployees(){

		$get_employers = FB::FB('employers/06004860000180/');

		foreach ($get_employers as $cpf => $employee) {
			$new_hcmcol000 = hcmcol000::new_hcmcol000($employee);
		}

	}
}
