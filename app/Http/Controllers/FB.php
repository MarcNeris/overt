<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Database;

class FB extends Controller

{

	public static function FB($reference){

	$pass = ServiceAccount::fromJsonFile(__DIR__.'/hcmrep-overt-firebase-adminsdk-zmdfu-fe9e3de9cd.json');

	$Firedb = (new Factory)

	->withServiceAccount($pass)

	->withDatabaseUri('https://hcmrep-overt.firebaseio.com/')

	->create();

	return $Firedb->getDatabase()->getReference($reference)->getValue();

	//$database = $firebase->getDatabase();
	//$DB = $database->getReference();

	//$snapshot = $DB->getSnapshot()->getValue();

	//dd($snapshot);

	//$newPost = $database->getReference('blog/posts');
	//$newPost = $database->getReference('LnC4h2we3aSkydy2ne4PfNIj7Xg2/10804639000183/01240025602/2018-06-27/');
	//$newPost = $database->getReference()->getValue();

	// $newPost = $database->getReference('blog/posts')->push([

	// 'title' => 'Marcelo Neris',

	// 'body' => 'Laravel com Firebase'

	// ]);

	//$read = $newPost->getValue();

	//dd($database);

	//$newPost->getKey(); // => -KVr5eu8gcTv7_AHb-3-

	//$newPost->getUri(); // => https://my-project.firebaseio.com/blog/posts/-KVr5eu8gcTv7_AHb-3-

	//$newPost->getChild('title')->set('Changed post title');

	//$newPost->getValue(); // Fetches the data from the realtime database

	//$newPost->remove();



	}

	public static function WR($reference,$data){

		$pass = ServiceAccount::fromJsonFile(__DIR__.'/hcmrep-overt-firebase-adminsdk-zmdfu-fe9e3de9cd.json');

		$Firedb = (new Factory)

		->withServiceAccount($pass)

		->withDatabaseUri('https://hcmrep-overt.firebaseio.com/')

		->create();

		return $Firedb->getDatabase()->getReference($reference)->set($data);
	}
}

