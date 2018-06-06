<?php

use Illuminate\Database\Seeder;
use App\Models\usersrole;

class usersrolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        usersrole::create([
            'SitReg'    => 1,
            'TipRol'    => 1,
            'SitRol'    => 1,
        	'NomRol'	=> 'CIO - Chief Information Officer',
            'DscRol'    => 'Perfil com acesso à todas as funções do Sistema',
        ]);

        usersrole::create([
            'SitReg'    => 1,
            'TipRol'    => 1,
            'SitRol'    => 1,
        	'NomRol'	=> 'CEO - Chief Executive Officer',
            'DscRol'    => 'Perfil com acesso a todos os dashboards e monitoramento',
        ]);

        usersrole::create([
            'SitReg'    => 1,
            'TipRol'    => 1,
            'SitRol'    => 1,
            'NomRol'    => 'CFO - Chief Financial Officer',
            'DscRol'    => 'Perfil com acesso aos dashboards Financeiros',
        ]);

        usersrole::create([
            'SitReg'    => 1,
            'TipRol'    => 1,
            'SitRol'    => 1,
            'NomRol'    => 'COO – Chief Operating Officer',
            'DscRol'    => 'Perfil com acesso aos dashboards Operacionais',
        ]);

        usersrole::create([
            'SitReg'    => 1,
            'TipRol'    => 1,
            'SitRol'    => 1,
            'NomRol'    => 'CHRO – Chief Human Resources Officer',
            'DscRol'    => 'Perfil com acesso aos dashboards de Recursos Humanos',
        ]);

        usersrole::create([
            'SitReg'    => 1,
            'TipRol'    => 1,
            'SitRol'    => 1,
            'NomRol'    => 'Controller',
            'DscRol'    => 'Perfil com acesso aos dashboards de Controladoria',
        ]);
    }
}
