<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\bamprd001;
use Session;
use Auth;

class getBamJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $bamprd001 = new bamprd001;
        $bamprd001['idUsuReg'] = rand(1, 2);
        $bamprd001['idPrpReg'] = rand(1, 2);
        $bamprd001['idUsuEdt'] = rand(1, 2);
        $bamprd001['idRegEnt'] = rand(1, 2);
        $bamprd001['idRegEmp'] = rand(1, 2);
        $bamprd001['idRegBam'] = rand(1, 2);
        $bamprd001['SitReg'] = 1;
        $bamprd001['SitBam'] = 1;
        $bamprd001['CodBam'] = 1;
        $bamprd001['DatMov'] = date('Y-m-d H:i:s');
        $bamprd001['NomMov'] = 'Gerado Pelo Sistema';
        $bamprd001['CodMov'] = 'BATATA';
        $bamprd001['VlrLin'] = rand(100, 2000);
        $bamprd001['VlrBar'] = rand(100, 2000).'.'.rand(0,99);
        $bamprd001['UniMed'] = 'Und';
        $bamprd001->save();
    }
}
