<?php

namespace App\Models\Senior;

use Illuminate\Database\Eloquent\Model;

class e070fil extends Model
{
    protected $connection = 'sapiens';
    protected $table 	  = 'e070fil';
    protected $primaryKey = 'codemp';
    //return $this->hasMany('App\Models\Senior\e070fil','CodEmp');
    public function e070emp()
    {
        return $this->belongsTo('App\Models\Senior\e070emp');
    }
}
