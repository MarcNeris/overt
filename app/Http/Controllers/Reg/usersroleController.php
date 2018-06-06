<?php

namespace App\Http\Controllers\Reg;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\usersrole;
use App\Models\users0002;
use App\Models\userstask;



class usersroleController extends Controller
{


    public function get_usersrole($id, users0002 $users0002){

    
    	//$userstasks = userstask::all();

		// foreach ($userstasks as $userstask) {
		
	 //    	try {
	 //    		$data['idRegRol'] = 1;
	 //    		$data['idRegTsk'] = $userstask->id;
	 //    		$data['SitTsk'] = 1;
	 //    		$users0002->new_users0002($data);

	 //    	} catch (\PDOException $e) {
	    		
	 //    	}
		// }

    	$usersroles = usersrole::where('SitReg',1)->where('id', $id)->with('roles')->first()->toArray();
    
    	return response()->json($usersroles);
    }
}
