<?php

use Illuminate\Database\Seeder;
use App\Models\users0002;

class users0002sSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //ADMIN
        users0002::create([
            'idRegRol' 	=> 1,
            'idRegTsk'  => 1,
            'SitTsk'    => 1,
        ]);

        users0002::create([
            'idRegRol' 	=> 1,
            'idRegTsk'  => 2,
            'SitTsk'    => 1,
        ]);

        users0002::create([
            'idRegRol' 	=> 1,
            'idRegTsk'  => 3,
            'SitTsk'    => 1,
        ]);

        users0002::create([
            'idRegRol'  => 1,
            'idRegTsk'  => 4,
            'SitTsk'    => 1,
        ]);
        
        users0002::create([
            'idRegRol'  => 1,
            'idRegTsk'  => 5,
            'SitTsk'    => 1,
        ]);

        users0002::create([
            'idRegRol'  => 1,
            'idRegTsk'  => 6,
            'SitTsk'    => 1,
        ]);

        users0002::create([
            'idRegRol'  => 1,
            'idRegTsk'  => 7,
            'SitTsk'    => 1,
        ]);
        //CEO
        users0002::create([
            'idRegRol'  => 2,
            'idRegTsk'  => 4,
            'SitTsk'    => 1,
        ]);
        
        users0002::create([
            'idRegRol'  => 2,
            'idRegTsk'  => 5,
            'SitTsk'    => 1,
        ]);

        users0002::create([
            'idRegRol'  => 2,
            'idRegTsk'  => 6,
            'SitTsk'    => 1,
        ]);

        users0002::create([
            'idRegRol'  => 2,
            'idRegTsk'  => 7,
            'SitTsk'    => 1,
        ]);
        //CFO
        users0002::create([
            'idRegRol'  => 3,
            'idRegTsk'  => 4,
            'SitTsk'    => 1,
        ]);
        //COO
        users0002::create([
            'idRegRol'  => 4,
            'idRegTsk'  => 5,
            'SitTsk'    => 1,
        ]);
        //CHRO
        users0002::create([
            'idRegRol'  => 5,
            'idRegTsk'  => 6,
            'SitTsk'    => 1,
        ]);
        //Controller
        users0002::create([
            'idRegRol'  => 6,
            'idRegTsk'  => 7,
            'SitTsk'    => 1,
        ]);
    }
}
