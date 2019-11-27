<?php

    namespace App\Policies;

    use Illuminate\Auth\Access\HandlesAuthorization;
    use App\Components\FlashMessages;
    use App\Models\Section;
    use App\User;

    class SectionPolicy {
        use HandlesAuthorization;
        use FlashMessages;

        public function change(User $user, Section $section) {
            $result = ($user->id === $section->user_id);
            if (!$result) {
                static::message('warning', 'Удалять или изменять можно только свои курсы!');
            };
            return $result;
        }
    }
