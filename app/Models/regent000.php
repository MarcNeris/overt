<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class regent000 extends Model
{	
	use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function new_regent000($Request)
    {    
        $regent000 = regent000::select('id')
                                ->where('RegFed',soNumero($Request['RegFed']))
                                ->where('idUsuReg',auth()->user()->id)
                                ->get();
        if(isset($regent000[0])){
            return $regent000[0]->id;
        }

        $regent000 = new regent000;
        $regent000['idPrpReg'] = auth()->user()->id;
        $regent000['idUsuReg'] = auth()->user()->id;
        $regent000['idUsuEdt'] = auth()->user()->id;
        $regent000['SitReg'] = 1;
        $regent000['SitEnt'] = 1;
        $regent000['RegFed'] = soNumero($Request['RegFed']);
        $regent000['NomEnt'] = $Request['NomFta'];
        $regent000['CodCne'] = $Request['CodCne'];
        $regent000['DatReg'] = Carbon::createFromFormat('d/m/Y', $Request['DatReg'])->format('Y-m-d');
        $regent000->save();
        return $regent000->id;
        
    }
}
