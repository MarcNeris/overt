<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function clearcache()
    {
       
    $exitCode = Artisan::call('cache:clear');
  
    $exitCode = Artisan::call('optimize');

    $exitCode = Artisan::call('route:cache');

    $exitCode = Artisan::call('route:clear');

    $exitCode = Artisan::call('view:clear');

    $exitCode = Artisan::call('config:cache');
    
    //return '<h1>Clear Config cleared</h1>';
    }
}
