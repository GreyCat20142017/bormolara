<?php

use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{

    public function run()
    {
        if (DB::table('courses')->get()->count() == 0) {
            DB::table('courses')->insert([
                [
                    'id' => 1,
                    'name' => 'own',
                ],
                [
                    'id' => 2,
                    'name' => 'basic',
                ],
                [
                    'id' => 3,
                    'name' => 'book',
                ],
                [
                    'id' => 4,
                    'name' => 'abc',
                ]
            ]);

        } else {
            echo "\e[31mТаблица не пустая. Заполнение данными отменено.";
        }
    }
}
