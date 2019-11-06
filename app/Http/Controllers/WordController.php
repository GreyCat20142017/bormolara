<?php

    namespace App\Http\Controllers;

    use App\Http\Requests\PhraseRequest;
    use App\Models\Word as CrudModel;
    use App;

    class WordController extends CrudController {

        protected $resource;
        protected $model;

        public function __construct() {

            $this->middleware('auth');
            $this->model = CrudModel::class;
            $this->resource = 'word';
            $this->modelsChildren = App::make($this->model)::getChildModels();
        }
    }
