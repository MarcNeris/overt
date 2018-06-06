<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
        	'name' 	   => 'overt Intelligence',
        	'email'    => 'overt@overt.com.br',
        	'password' =>  bcrypt('overt@@2')
        ]);
        
        User::create([
            'name'     => 'User',
            'email'    => 'user@overt.com',
            'password' =>  bcrypt('overt@@2')      	
        ]); 
    }
}
