<?php

    namespace App\Http\Controllers;

    use App;
    use App\Http\Requests\PhraseRequest;
    use App\Models\Phrase as CrudModel;

    class PhraseController extends CrudController {

        protected $resource;
        protected $model;

        public function __construct() {

            $this->middleware('auth');
            $this->model = CrudModel::class;
            $this->resource = 'phrase';
            $this->modelsChildren = App::make($this->model)::getChildModels();
        }
    }
