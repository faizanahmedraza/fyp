<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call([
             UserSeeder::class,
             OricMemberSeeder::class,
             StudentSeeder::class,
             ResearcherSeeder::class,
             FacultySeeder::class,
             FocalPersonSeeder::class
         ]);
    }
}
