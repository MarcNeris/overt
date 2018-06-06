<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class bamprd000 extends Model
{
    public function bamprd001()
    {
        return $this->hasMany('App\Models\bamprd001','idRegBam');
    }
}
