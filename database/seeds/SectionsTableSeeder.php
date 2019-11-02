<?php

    use Illuminate\Database\Seeder;

    class SectionsTableSeeder extends Seeder {

        public function run() {
            if (DB::table('sections')->get()->count() == 0) {
                DB::table('sections')->insert([
                    [
                        'id' => 1,
                        'name' => 'own',
                        'hidden' => 0,
                        'own' => 1
                    ]

                ]);
                for ($i = 1; $i <= 10; $i++) {
                    DB::table('sections')->insert([
                        [
                            'id' => $i + 1,
                            'name' => 'Present simple ' . $i,
                            'hidden' => 0,
                            'own' => 0
                        ]

                    ]);
                }
            } else {
                echo "\e[31mТаблица не пустая. Заполнение данными отменено.";
            }
        }
    }
