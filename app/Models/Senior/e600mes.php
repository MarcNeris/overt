<?php

namespace App\Models\Senior;

use Illuminate\Database\Eloquent\Model;

class e600mes extends Model
{
    protected $connection = 'sapiens';
    protected $table 	  = 'e600mes';
    protected $primaryKey = 'NumCco';//['CodEmp','NumCco'];
    protected $keyType    = 'string';
}
