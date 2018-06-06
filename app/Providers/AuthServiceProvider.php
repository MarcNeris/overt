<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use App\Models\users0001;
use App\Models\usersrole;
use App\Models\userstask;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        //'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services. /Marcelo Neris
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        if (Schema::hasTable('users0001s')&&Schema::hasTable('userstasks')) {

            $userstasks = userstask::all();

            foreach ($userstasks as $userstask) {

                Gate::define($userstask->NomTsk, function ($user, $idRegEmp=null) use($userstask){
       
                    $idRegRol = users0001::where('user_id', $user->id)
                    ->where('idRegEmp', $idRegEmp)
                    ->value('idRegRol');

                    $usersroles = usersrole::with('roles')->find($idRegRol);

                    if (is_null($idRegEmp)) {
                        
                        return false;
                    }
                    
                    return $usersroles->roles->contains('NomTsk', $userstask->NomTsk);
                                        
                });  
            }
        } 
    }
}