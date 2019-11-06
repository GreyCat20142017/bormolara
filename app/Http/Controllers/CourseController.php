<?php

    namespace App\Http\Controllers;

    use App\Http\Requests\PhraseRequest;
    use App\Models\Course as CrudModel;
    use App;

    class CourseController extends CrudController {

        protected $resource;
        protected $model;

        public function __construct() {
            $this->middleware('auth');
            $this->model = CrudModel::class;
            $this->resource = 'course';
            $this->modelsChildren = App::make($this->model)::getChildModels();
        }
    }
