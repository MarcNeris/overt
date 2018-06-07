<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //DB::unprepared("Exec sp_defaultlanguage 'overt', 'us_english' Reconfigure");
    	$this->call(UsersTableSeeder::class);
      $this->call(usersrolesSeeder::class);
      $this->call(userstasksSeeder::class);
      $this->call(bamprd000sSeeder::class);
      $this->call(regcne000sSeeder::class);
      $this->call(regmun000sSeeder::class);
      $this->call(users0002sSeeder::class);
    }
}
