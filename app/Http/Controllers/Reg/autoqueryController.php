<?php

namespace App\Http\Controllers\Reg;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Models\regmun000;
use App\Models\regcne000;
use App\Models\usersrole;

class autoqueryController extends Controller
{
    //
    //Buscar Municípios
    //
    public function regmun000(Request $Request){
        $term = Input::get('query');       
        
        $queries = regmun000::select('CodMun','NomMun','CodUfe')

            ->where('NomMun', 'LIKE', '%'.$term.'%')
            ->orWhere('CodMun', 'LIKE', '%'.$term.'%')
     
        	->orderBy('NomMun')
            ->take(10)->get();
        
        $results=[];
        foreach ($queries as $query)
        {
            $results['suggestions'][] = [ 'data' => $query->CodMun,'value' => $query->NomMun.' - '.$query->CodUfe];
        }

    return  response()->json($results);
	}
    //
    //
    //
    public function regcne000(Request $Request){
        $term = Input::get('query');       
        
        $queries = regcne000::select('CodCne','DscCne')->where('DscCne', 'LIKE', '%'.$term.'%')
     
            ->orderBy('DscCne')
            ->take(10)->get();
        
        $results=[];
        foreach ($queries as $query)
        {
            $results['suggestions'][] = [ 
                'data' => $query->CodCne, 
                'value' => $query->DscCne
            ];
        }

    return  response()->json($results);
    }
    //
    //
    //
    public function usersrole(Request $Request){
        $term = Input::get('query'); 
        
        $usersroles = usersrole::select('id','NomRol','DscRol')//->where('NomRol', 'LIKE', '%'.$term.'%')
            ->orderBy('NomRol')
            ->take(10)->get();
        
        $results=[];
        foreach ($usersroles as $usersrole)
        {
            $results['suggestions'][] = [ 
                'data' => $usersrole->id, 
                'value' => $usersrole->NomRol.' - '.$usersrole->DscRol
            ];
        }

    return  response()->json($results);
    }
}
