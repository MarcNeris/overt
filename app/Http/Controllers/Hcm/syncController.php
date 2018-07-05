<?php

namespace App\Http\Controllers\Hcm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\hcmcol000;
use Session;

use App\Jobs\Sync;

use App\Jobs\employersJob;
use App\Jobs\employeesJob;

use App\Http\Controllers\FB;
use App\Http\Controllers\Hcm\uploadController;
use App\Http\Controllers\Hcm\downloadController;
use App\Http\Controllers\Hcm\syncController;

class syncController extends Controller
{
	
	public static function sync(){


		downloadController::updEmployees();

		//employersJob::dispatch();
		//employeesJob::dispatch();
	
	}

    public static function getEmployees(){

		$get_employers = FB::FB('employers/06004860000180/');

		foreach ($get_employers as $cpf => $employee) {
			$new_hcmcol000 = hcmcol000::new_hcmcol000($employee);
		}

		return true;
	}

	/*public static function syncEmployees(){

		$employees=FB::FB('employees/06004860000180/');

				dd($employees);
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
	}*/
}
