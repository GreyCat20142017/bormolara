<?php

    use Illuminate\Database\Seeder;
    use Illuminate\Support\Carbon;

    class UsersTableSeeder extends Seeder {
        public function run() {
            if (DB::table('users')->get()->count() == 0) {
                DB::table('users')->insert([
                    [
                        'id' => 1,
                        'name' => 'admin',
                        'email' => 'zz@zz.zz',
                        'password' => bcrypt('zzzzz'),
                        'email_verified_at' => now(),
                        'remember_token' => 'zzzzz55555',
                        'admin' => 1,
                        'created_at' => Carbon::now()
                    ],
                    [
                        'id' => 2,
                        'name' => 'datauser',
                        'email' => 'tt@tt.tt',
                        'password' => bcrypt('ttttt'),
                        'email_verified_at' => now(),
                        'remember_token' => 'ttttt55555',
                        'admin' => 0,
                        'created_at' => Carbon::now()
                    ]

                ]);

            } else {
                echo "\e[31mТаблица не пустая. Заполнение данными отменено.";
            }
        }
    }

