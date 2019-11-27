<?php

    use Illuminate\Database\Seeder;

    class SectionsTableSeeder extends Seeder {

        public function run() {
            if (DB::table('sections')->get()->count() == 0) {
                for ($i = 1; $i <= 10; $i++) {
                    DB::table('sections')->insert([
                        [
                            'id' => $i + 1,
                            'name' => 'Present simple ' . $i,
                            'user_id' => 1
                        ]

                    ]);
                }
            } else {
                echo "\e[31mТаблица не пустая. Заполнение данными отменено.";
            }
        }
    }
