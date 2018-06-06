<?php

namespace App\Models\Senior;

use Illuminate\Database\Eloquent\Model;

class e070emp extends Model
{
    protected $connection = 'sapiens';
    protected $table 	  = 'e070emp';
    protected $primaryKey = 'codemp';

    public function e070fil()
    {
        return $this->hasMany('App\Models\Senior\e070fil','codemp');
    }
}
