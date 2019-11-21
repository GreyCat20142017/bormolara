<?php

    namespace App\Http\Controllers;

    use App\Models\Course;
    use App\Http\Requests\CourseRequest;

    class CourseController extends CrudController {

        public function __construct() {
            $this->fillClassProperties('course', Course::class, CourseRequest::class);
        }
    }
