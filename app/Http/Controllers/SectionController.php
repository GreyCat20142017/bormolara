<?php

    namespace App\Http\Controllers;

    use App\Http\Requests\PhraseRequest;
    use App\Models\Section as CrudModel;

    class SectionController extends CrudController {

        protected $resource;
        protected $model;

        public function __construct() {

            $this->middleware('auth');
            $this->model = CrudModel::class;
            $this->resource = 'section';
        }
    }
