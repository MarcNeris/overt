<?php

use Illuminate\Database\Seeder;
use App\Models\bamprd000;

class bamprd000sSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
    	bamprd000::create([
        	'idUsuReg' 	=> 1,
        	'idPrpReg' 	=> 1,
        	'idUsuEdt'  => 1,
        	'idRegEnt' 	=> 1,
        	'idRegEmp' 	=> 1,
        	'SitReg' 	=> 1,
        	'SitBam' 	=> 1,
        	'TipBam'	=> 'RealTime',
        	'CodBam'	=> 1000,
        	'NomBam'	=> 'Default BAM',
        	'TitBam'	=> 'Production',
        	'TitLin'	=> 'Meta',
        	'TitBar'	=> 'Produção',
        	'DscBam'	=> 'Monitoramento RealTime Default',
        	'TmpUdt'	=> 1000
        ]);
    }
}
