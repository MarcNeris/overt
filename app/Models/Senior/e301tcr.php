<?php

namespace App\Models\Senior;

use Illuminate\Database\Eloquent\Model;

class e301tcr extends Model
{
    protected $primaryKey = 'NumTit';
    protected $connection = 'sapiens';
    protected $table = 'e301tcr';
}
