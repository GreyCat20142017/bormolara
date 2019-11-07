<?php

    namespace App\Http\Controllers;

    use App\Models\Course as CrudModel;

    class CourseController extends CrudController {

        public function __construct() {
            $this->fillClassProperties('course', CrudModel::class);
        }
    }
