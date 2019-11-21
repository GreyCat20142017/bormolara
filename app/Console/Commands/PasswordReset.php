<?php

    namespace App\Console\Commands;

    use Illuminate\Console\Command;
    use App\User;


    class PasswordReset extends Command {
        /**
         * The name and signature of the console command.
         *
         * @var string
         */
        protected $signature = 'my:user:password {email} {password}';

        /**
         * The console command description.
         *
         * @var string
         */
        protected $description = 'Изменить пароль пользователя по email (my:user:password <email> <новый пароль>)';

        /**
         * Create a new command instance.
         *
         * @return void
         */
        public function __construct() {
            parent::__construct();
        }

        /**
         * Execute the console command.
         *
         * @return mixed
         */
        public function handle() {
            $email = $this->argument('email');
            $password = $this->argument('password');
            $user = User::whereEmail($email)->first();
            if ($user) {
                $user->password = bcrypt($password);
                $user->save();
                $this->info('Пароль успешно изменен!');
            } else {
                $this->error('Пользователь ' . $email . ' не найден!');
            }
        }
    }
