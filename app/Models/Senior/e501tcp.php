<?php

namespace App\Models\Senior;

use Illuminate\Database\Eloquent\Model;

class e501tcp extends Model
{
    protected $primaryKey = 'NumTit';
    protected $connection = 'sapiens';
    protected $table = 'e501tcp';
}
