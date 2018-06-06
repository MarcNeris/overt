<?php

use Illuminate\Database\Seeder;
use App\Models\userstask;

class userstasksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        userstask::create([
            'SitReg'    => 1,
            'TipTsk'    => 1,
            'SitTsk'    => 1,
        	'NomTsk'	=> 'Criar Empresa',
            'DscTsk'    => 'Permite criar um novo usuário na empresa logada',
        ]);

        userstask::create([
            'SitReg'    => 1,
            'TipTsk'    => 1,
            'SitTsk'    => 1,
            'NomTsk'    => 'Criar Usuário',
            'DscTsk'    => 'Permite criar um novo usuário na empresa logada',
        ]);

        userstask::create([
            'SitReg'    => 1,
            'TipTsk'    => 1,
            'SitTsk'    => 1,
            'NomTsk'    => 'Alterar Usuário',
            'DscTsk'    => 'Permite alterar o Perfil do Usuário',
        ]);

        userstask::create([
            'SitReg'    => 1,
            'TipTsk'    => 1,
            'SitTsk'    => 1,
            'NomTsk'    => 'Finanças',
            'DscTsk'    => 'Visualisa os Dashboards Financeiros',
        ]);

        userstask::create([
            'SitReg'    => 1,
            'TipTsk'    => 1,
            'SitTsk'    => 1,
            'NomTsk'    => 'Operações',
            'DscTsk'    => 'Visualisa os Dashboards Operacionais/Produção',
        ]);

        userstask::create([
            'SitReg'    => 1,
            'TipTsk'    => 1,
            'SitTsk'    => 1,
            'NomTsk'    => 'Recursos Humanos',
            'DscTsk'    => 'Visualisa os Dashboards de Recursos Humanos',
        ]);

        userstask::create([
            'SitReg'    => 1,
            'TipTsk'    => 1,
            'SitTsk'    => 1,
            'NomTsk'    => 'Controladoria',
            'DscTsk'    => 'Visualisa os Dashboards de Controladoria',
        ]);
    }
}
