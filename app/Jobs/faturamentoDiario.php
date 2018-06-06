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

class faturamentoDiario implements ShouldQueue
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
        $bamprd001['idUsuReg'] = 1;
        $bamprd001['idPrpReg'] = 1;
        $bamprd001['idUsuEdt'] = 1;
        $bamprd001['idRegEnt'] = 1;
        $bamprd001['idRegEmp'] = 1;
        $bamprd001['idRegBam'] = 1;
        $bamprd001['SitReg'] = 1;
        $bamprd001['SitBam'] = 1;
        $bamprd001['CodBam'] = 1;
        $bamprd001['DatMov'] = date('Y-m-d H:i:s');
        $bamprd001['NomMov'] = 'Gerado pelo Sistema Teste';
        $bamprd001['CodMov'] = 'BAM1000';
        $bamprd001['VlrLin'] = rand(10000, 20000).'.'.rand(0,99);
        $bamprd001['VlrBar'] = rand(10000, 20000).'.'.rand(0,99);
        $bamprd001['UniMed'] = 'UND';
        $bamprd001->save();
    }
}
