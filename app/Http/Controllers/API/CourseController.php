<?php

    namespace App\Http\Controllers\API;

    use App\Http\Controllers\Controller;
    use App\Models\Course;
    use Illuminate\Http\Request;

    class CourseController extends Controller {

        public function courses(Request $request) {
            if ($request->has(['course', 'lesson', 'offline'])) {
                $course = Course::findOrFail(intval($request->get('course')));
                $lesson = intval($request->get('lesson'));
                return $course->wordsForOffline($lesson)->toArray();
            } elseif ($request->has(['course', 'lesson'])) {
                $course = Course::findOrFail(intval($request->get('course')));
                $lesson = intval($request->get('lesson'));
                return $course->wordsByLesson($lesson)->toArray();
            } else {
                return Course::enabledCoursesInfo()->toArray();
            }
        }
    }
