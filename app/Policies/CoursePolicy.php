<?php

    namespace App\Policies;

    use App\Components\FlashMessages;
    use Illuminate\Auth\Access\HandlesAuthorization;
    use App\User;
    use App\Models\Course;

    class CoursePolicy {
        use HandlesAuthorization;
        use FlashMessages;

        public function change(User $user, Course $course) {
            $result = ($user->id === $course->user_id);
            if (!$result) {
                static::message('warning', 'Удалять или изменять можно только свои курсы!');
            };
            return $result;
        }
    }
