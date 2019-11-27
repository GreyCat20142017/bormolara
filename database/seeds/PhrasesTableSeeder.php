<?php

    use Illuminate\Database\Seeder;

    class PhrasesTableSeeder extends Seeder {

        public function run() {
            if (DB::table('phrases')->get()->count() == 0) {
                $file = base_path('bormo_phrases.csv');
                $query = 'LOAD DATA LOCAL INFILE "' . $file . '"
                        INTO TABLE phrases FIELDS TERMINATED BY  ","  LINES TERMINATED BY  "\n"  IGNORE 1 LINES 
                            (id, section_id, english, russian)';
                DB::connection()->getpdo()->exec($query);

            } else {
                echo "\e[31mТаблица phrases не пустая. Заполнение данными отменено.";
            }
        }
    }
