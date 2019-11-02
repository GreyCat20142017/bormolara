<?php

    use Illuminate\Database\Seeder;

    class WordsTableSeeder extends Seeder {

        public function run() {

            if (DB::table('words')->get()->count() == 0) {
                $file = base_path('bormo_words.csv');
                $query = 'LOAD DATA LOCAL INFILE "' . $file . '"
                        INTO TABLE words FIELDS TERMINATED BY  "," OPTIONALLY ENCLOSED BY "~"  
                        LINES TERMINATED BY  "\n"  IGNORE 1 LINES 
                            (id, course_id, english, russian)';
                DB::connection()->getpdo()->exec($query);
            } else {
                echo "\e[31mТаблица words не пустая. Заполнение данными отменено.";
            }
        }
    }
