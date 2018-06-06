<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

use App\Models\userstask;

class usersrole extends Model
{
    public function user(){

    	return $this->belongsToMany(User::class);
    }
	    
    public function roles(){

        return $this->belongsToMany(userstask::class, 'users0002s', 'idRegRol', 'idRegTsk')->wherePivot('SitTsk', 1);
    }
}
