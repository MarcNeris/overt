<?php

namespace App\Http\Controllers\Hcm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\regemp000;
use App\Models\Senior\r046ver;
use App\Http\Controllers\FS;
use App\Http\Controllers\FB;
use DB;

class uploadController extends Controller
{
    public static function employersUpload(){

    	$regemp000 = regemp000::join('regpsa000s','regpsa000s.id','regemp000s.idRegPsa')		
    	->select('ChaCli','RegFed')
        ->first();

		$uploadData = DB::connection('vetorh')->select("

			SELECT R034FUN.NUMEMP,
			CASE WHEN R038HFI.NUMCGC IS NULL THEN 0 ELSE R038HFI.NUMCGC END NUMCGC,
			CASE WHEN R038HFI.NOMFIL IS NULL THEN '' ELSE R038HFI.NOMFIL END NOMFIL,
			R034FUN.NUMCAD,
			R034FUN.NOMFUN,
			CASE WHEN R038AFA.SITAFA IS NULL THEN 1 ELSE R038AFA.SITAFA END SITAFA,
			R034FUN.NUMCTP,
			R034FUN.NUMCPF,
			R034FUN.NUMPIS,
			R034FUN.DATNAS,
			R034FUN.DATADM,
			CASE WHEN R038HCH.NUMCRA IS NULL THEN 0 ELSE R038HCH.NUMCRA END NUMCRA 
		  	FROM R034FUN
		  	LEFT JOIN (SELECT R038HFI.NUMEMP,
	  					R038HFI.TIPCOL,
	  					R038HFI.NUMCAD,
	  					R038HFI.EMPATU,
	  					R038HFI.CADATU,
	  					R038HFI.CODFIL,R038HFI.DATALT,R030FIL.NOMFIL,R030FIL.NUMCGC 
				        FROM R038HFI INNER JOIN R030FIL ON R038HFI.NUMEMP = R030FIL.NUMEMP
						                              AND R038HFI.CODFIL = R030FIL.CODFIL) R038HFI 
				ON R034FUN.NUMEMP = R038HFI.NUMEMP
			   AND R034FUN.TIPCOL = R038HFI.TIPCOL
			   AND R034FUN.NUMCAD = R038HFI.NUMCAD
			   AND R034FUN.NUMEMP = R038HFI.EMPATU
			   AND R034FUN.NUMCAD = R038HFI.CADATU


			   AND R038HFI.DATALT = (SELECT MAX(HFI.DATALT)
									   FROM R038HFI HFI
									  WHERE HFI.NUMEMP = R038HFI.NUMEMP
									    AND HFI.TIPCOL = R038HFI.TIPCOL
										AND HFI.NUMCAD = R038HFI.NUMCAD
										AND HFI.NUMEMP = HFI.EMPATU
										AND HFI.NUMCAD = HFI.CADATU
										AND ((HFI.DATALT <= GETDATE()
										AND R034FUN.DATADM <= GETDATE())
										 OR (R034FUN.DATADM > GETDATE()
										AND HFI.DATALT = R034FUN.DATADM)))
		  LEFT JOIN (SELECT R038AFA.NUMEMP,R038AFA.TIPCOL,R038AFA.NUMCAD,R038AFA.DATAFA,R038AFA.DATTER,R038AFA.SITAFA,R010SIT.DESSIT
					   FROM R038AFA INNER JOIN R010SIT ON R038AFA.SITAFA = R010SIT.CODSIT
													  AND R010SIT.TIPSIT NOT IN(15,16,17,18)) R038AFA 
				 ON R034FUN.NUMEMP = R038AFA.NUMEMP
				AND R034FUN.TIPCOL = R038AFA.TIPCOL
				AND R034FUN.NUMCAD = R038AFA.NUMCAD
				AND R038AFA.DATAFA <= GETDATE()
				AND ((R038AFA.DATTER >= GETDATE())
				  OR (R038AFA.DATTER = 364))
		  LEFT JOIN R038HCH
		         ON R038HCH.NUMEMP = R034FUN.NUMEMP
				AND R038HCH.TIPCOL = R034FUN.TIPCOL
				AND R038HCH.NUMCAD = R034FUN.NUMCAD

				AND R038HCH.TIPCRA = 1
				AND R038HCH.DATINI = (SELECT MAX(HCH.DATINI)              
		                                FROM R038HCH HCH                  
		                               WHERE HCH.NUMEMP = R038HCH.NUMEMP  
									     AND HCH.TIPCOL = R038HCH.TIPCOL  
										 AND HCH.NUMCAD = R038HCH.NUMCAD  
										 AND HCH.TIPCRA = R038HCH.TIPCRA   
										 AND HCH.DATINI <= GETDATE()                
										 AND ((R038HCH.DATFIM >= GETDATE())   
		                                   OR (R038HCH.DATFIM = 364)    
		                                   OR (R038HCH.DATFIM = R038HCH.DATINI))) 
				AND R038HCH.HORINI = (SELECT MAX(HCH.HORINI)              
		                                FROM R038HCH HCH                  
		                               WHERE HCH.NUMEMP = R038HCH.NUMEMP  
		                                 AND HCH.TIPCOL = R038HCH.TIPCOL  
		                                 AND HCH.NUMCAD = R038HCH.NUMCAD  
		                                 AND HCH.DATINI = R038HCH.DATINI                
		                                 AND HCH.TIPCRA = R038HCH.TIPCRA   
		                                 AND HCH.HORINI <= 1439      
										 AND ((R038HCH.DATFIM >= GETDATE())   
		                                   OR (R038HCH.DATFIM = 364)    
		                                   OR (R038HCH.DATFIM = R038HCH.DATINI)))
		  WHERE NOT EXISTS (SELECT 1 
							  FROM R038AFA
							 WHERE R038AFA.NUMEMP = R034FUN.NUMEMP
							   AND R038AFA.TIPCOL = R034FUN.TIPCOL
							   AND R038AFA.NUMCAD = R034FUN.NUMCAD
							   AND R038AFA.DATAFA = (SELECT MAX(R038AFA.DATAFA)
													   FROM R038AFA,
															R010SIT
													  WHERE R038AFA.NUMEMP = R034FUN.NUMEMP
													    AND R038AFA.TIPCOL = R034FUN.TIPCOL
														AND R038AFA.NUMCAD = R034FUN.NUMCAD
														AND R038AFA.DATAFA <= GETDATE()
														AND R038AFA.SITAFA = R010SIT.CODSIT
														AND R010SIT.TIPSIT = 7))								   

		");

		$db = FS::FS();
		

		$employees =[];
		
		foreach ($uploadData as $key => $r034fun) {

			$NumCgc = str_pad($r034fun->NUMCGC, 14, '0', STR_PAD_LEFT);
			
			//foreach ($regemp000s as $key => $regemp000) {

			if($regemp000->RegFed==$NumCgc){

				$NumCpf = str_pad($r034fun->NUMCPF, 11, '0', STR_PAD_LEFT);
				$NumPis = str_pad($r034fun->NUMPIS, 11, '0', STR_PAD_LEFT);
				
				$DatNas = substr($r034fun->DATNAS,0,10);
				$DatAdm = substr($r034fun->DATADM,0,10);

				$employees[$NumCpf]['NumEmp'] =  $r034fun->NUMEMP;
				$employees[$NumCpf]['NumCgc'] =  $NumCgc;
				$employees[$NumCpf]['NomEmp'] =  $r034fun->NOMFIL;
				$employees[$NumCpf]['NumCad'] =  $r034fun->NUMCAD;
				$employees[$NumCpf]['NumCra'] =  $r034fun->NUMCRA;
				$employees[$NumCpf]['NomFun'] =  $r034fun->NOMFUN;
				$employees[$NumCpf]['SitAfa'] =  $r034fun->SITAFA;
				$employees[$NumCpf]['NumCtp'] =  $r034fun->NUMCTP;
				$employees[$NumCpf]['NumCpf'] =  $NumCpf;
				$employees[$NumCpf]['NumPis'] =  $NumPis;
				$employees[$NumCpf]['DatNas'] =  $DatNas;
				$employees[$NumCpf]['DatAdm'] =  $DatAdm;

				//$employersRef = $db->collection('employers/contracts/'.$NumCgc);
				//$employersRef->document($NumCpf)->set($employees, ['merge' => true]);
			}
			//}		
		};

		//$r046ver = r046ver::limit(1)->get()->toArray();

		//$db->document('x/'.$regemp000->RegFed)->set($r046ver);
		$FBWR = FB::WR('employers/'.$regemp000->RegFed, $employees);
		dd($employees);


		//$addedDocRef = $db->document('contracts/'.$regemp000->RegFed)->set($employees);//, ['merge' => true]);

		//dd($employees);

		


	}
}
