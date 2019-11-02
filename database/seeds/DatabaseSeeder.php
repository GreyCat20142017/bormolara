<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
         $this->call(UsersTableSeeder::class);
         $this->call(CoursesTableSeeder::class);
         $this->call(WordsTableSeeder::class);
         $this->call(SectionsTableSeeder::class);
         $this->call(PhrasesTableSeeder::class);
    }
}
