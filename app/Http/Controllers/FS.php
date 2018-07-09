<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google\Cloud\Firestore\FirestoreClient;

class FS extends Controller
{	
	public static function FS(){

		$FS = new FirestoreClient([
			'keyFile' => json_decode(file_get_contents(__DIR__ .'/hcmrep-overt-firebase-adminsdk-zmdfu-fe9e3de9cd.json'), true)
		]);

		return $FS;
	}
}
