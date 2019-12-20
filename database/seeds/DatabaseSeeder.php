<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    private $seeders = [
        UsersTableSeeder::class,
       # UserClientTableSeeder::class,
      #  CategoryProductTableSeeder::class
    ];

    public function run()
    {
        $this->call($this->seeders);
    }
}

