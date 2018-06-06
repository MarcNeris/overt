<?php

namespace App\Http\Controllers\Bam;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\bamprd000;
use App\Models\bamprd001;
use App\Models\regempusu;
use App\Models\users0001;
use App\Models\users0002;
use App\Models\usersrole;
use App\Jobs\getBamJob;
use App\Jobs\faturamentoDiario;
use Session;
use Gate;
use DB;
use Log;
use App\User;

    
class bamprd000Controller extends Controller
{   
    

    public function get_barra($CodBam){

        ativaModulo('BAM');

        //if (Gate::denies('Bam1000', Session::get('idRegEmp'))) {
        //   return response()->json(['error'=>'BAM - Acesso Negado, verifique com o Administrador']);
        //}


        $barra=[];

        for ($x = 0; $x <= 11; $x++) {

            $hora = date("G").':00:00';
            $hora = date('G', strtotime(-$x.' hour', strtotime($hora)));
            
            $bamprd001[] = bamprd001::select(
                'CodMov',
                DB::raw('SUM(bamprd001s.VlrLin) as VlrLin'),
                DB::raw('SUM(bamprd001s.VlrBar) as VlrBar'))
                ->groupBy('CodMov')
                ->join('bamprd000s', 'bamprd000s.id', '=', 'bamprd001s.idRegBam')
                ->where('bamprd001s.idRegEnt', Session::get('idRegEnt'))
                ->where('bamprd001s.idRegEmp', Session::get('idRegEmp'))
                //->where(DB::raw('DATE_FORMAT(bamprd001s.DatMov, "%H")'), $hora-$x)//MySql
                //->where(DB::raw('DATE_FORMAT(bamprd001s.DatMov, "%Y-%m-%d")'), $dia)//MySql
                //->where(DB::raw("FORMAT(bamprd001s.DatMov, 'H')"), $hora-$x)
                ->where(DB::raw("DATEPART(HOUR, bamprd001s.DatMov)"), $hora)//SQLServer
                ->whereDate('bamprd001s.DatMov', date("Y-m-d"))
                ->where('bamprd000s.CodBam', $CodBam)
                ->get()->toArray();

        
            if(isset($bamprd001[$x][0])){

                //$barra[$x]['VlrLin']=shortNumber($bamprd001[$x][0]['VlrLin']);
                $barra[$x]['VlrBar']=$bamprd001[$x][0]['VlrBar'];
                $barra[$x]['HraMov']=$hora.'h';
                $barra[$x]['ShtNum']=shortNumber($barra[$x]['VlrBar']);

            } else{

                $barra[$x]['HraMov']=$hora.'h';

            }

        }

        //dd($barra);

        return response()->json($barra);
    }



    

    public function get_bamprd000($CodBam){

        //Log::info("Início do Job getBamJob");
            
            
            //$this->dispatch(new getBamJob());
            // $this->dispatch(new faturamentoDiario());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new faturamentoDiario());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new faturamentoDiario());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new faturamentoDiario());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new faturamentoDiario());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new faturamentoDiario());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new faturamentoDiario());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new faturamentoDiario());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new faturamentoDiario());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new faturamentoDiario());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new faturamentoDiario());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new faturamentoDiario());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new faturamentoDiario());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new faturamentoDiario());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new faturamentoDiario());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
            // $this->dispatch(new getBamJob());
        //Log::info("Fim do Job getBamJob");
        
        //$this->dispatch(new faturamentoDiario());
        $queue = $this->dispatch(new faturamentoDiario());


        $bamprd001 = bamprd001::select(
            //DB::raw('DATE_FORMAT(bamprd001s.DatMov, "%H:%i:%s") as DatMov'),//MySql
            DB::raw("TOP 1 FORMAT(bamprd001s.DatMov, 'HH:mm:ss') as DatMov"),//SQL
            'bamprd001s.CodMov',
            'bamprd001s.NomMov',
            'bamprd001s.VlrLin',
            'bamprd001s.VlrBar')
            ->join('bamprd000s', 'bamprd000s.id', '=', 'bamprd001s.idRegBam')
            ->where('bamprd001s.idRegEnt', Session::get('idRegEnt'))
            ->where('bamprd001s.idRegEmp', Session::get('idRegEmp'))
            ->where('bamprd000s.CodBam', $CodBam)
            ->orderBy('bamprd001s.id', 'Desc')
            //->limit(1)
            ->get();



        //dd($bamprd001);


    	return response()->json($bamprd001);
    }



    public function bam($CodBam)
    {
        ativaModulo('BAM');

        $bamprd000 = bamprd000
            ::select(
            'bamprd000s.CodBam',
            'bamprd000s.NomBam',
            'bamprd000s.TipBam',
            'bamprd000s.TitBam',
            'bamprd000s.TitLin',
            'bamprd000s.TitBar',
            'bamprd000s.DscBam',
            'bamprd000s.TmpUdt'
            )
            ->where('bamprd000s.idRegEnt', Session::get('idRegEnt'))
            ->where('bamprd000s.idRegEmp', Session::get('idRegEmp'))
            ->where('bamprd000s.SitBam', 1)
            ->where('bamprd000s.CodBam', $CodBam)
            ->limit(1)
            ->get()->toArray();

            if (!isset($bamprd000[0]))
               abort(403, Session::get('NomFta').' | Esta Empresa/Entidade não tem Nenhum Monitoramento Ativo.');
            
        $bamprd000=$bamprd000[0];

    	return view('bam.bam', compact('bamprd000'));
    }


}

