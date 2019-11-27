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
                    'user_id' => 1
                ],
                [
                    'id' => 2,
                    'name' => 'basic',
                    'user_id' => 1
                ],
                [
                    'id' => 3,
                    'name' => 'book',
                    'user_id' => 1
                ],
                [
                    'id' => 4,
                    'name' => 'abc',
                    'user_id' => 1
                ]
            ]);

        } else {
            echo "\e[31mТаблица не пустая. Заполнение данными отменено.";
        }
    }
}
