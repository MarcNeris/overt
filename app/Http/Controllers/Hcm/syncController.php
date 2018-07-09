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
use App\Http\Controllers\FS;
use App\Http\Controllers\Hcm\uploadController;
use App\Http\Controllers\Hcm\downloadController;
use App\Http\Controllers\Hcm\syncController;


class syncController extends Controller
{
	
	public static function sync(){

		employersJob::dispatch();
		//employeesJob::dispatch();

		//uploadController::employersUpload();

		$db = FS::FS();


		$docRef = $db->collection('users/REP/AMoV2JPpihUIrfa8QN47ANN3krf1/06004860000180/2018-07-09')->document('09-22');
		$snapshot = $docRef->snapshot();


		$pontoRef = $db->collection('users/REP/AMoV2JPpihUIrfa8QN47ANN3krf1/06004860000180/2018-07-09');
		$marcacoes = $pontoRef->documents();

	//		dd($marcacoes);
		foreach ($marcacoes as $marcacao) {
		//	dd($marcacao->data());
		}


	

















		//echo "Hello " . $snapshot['firstName'];

		//downloadController::updEmployees();

		
	
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
