<?php

    namespace App\Policies;

    use Illuminate\Auth\Access\HandlesAuthorization;
    use App\Components\FlashMessages;
    use App\User;
    use App\Models\Phrase;

    class PhrasePolicy {
        use HandlesAuthorization;
        use FlashMessages;

        public function change(User $user, Phrase $phrase) {
            $parentUserId = $phrase->section()->get()->first()->user_id ?? 0;
            $result = ($user->id === $parentUserId);
            if (!$result) {
                static::message('warning', 'Удалять или изменять можно только контент своих курсов!');
            };
            return $result;
        }
    }
