<?php

    namespace App\Policies;

    use Illuminate\Auth\Access\HandlesAuthorization;
    use App\Components\FlashMessages;
    use App\User;
    use App\Models\Word;
    use App\Models\Course;

    class WordPolicy {
        use HandlesAuthorization;
        use FlashMessages;

        public function change(User $user, Word $word) {
            $parentUserId = $word->course()->get()->first()->user_id ?? 0;
            $result = ($user->id === $parentUserId);
            if (!$result) {
                static::message('warning', 'Удалять или изменять можно только контент своих курсов!');
            };
            return $result;
        }
    }
