<?php

    namespace App\Http\Controllers;

    use App\Models\Section;

    class SectionController extends CrudController {

        protected $resource;
        protected $model;

        public function __construct() {
            $this->fillClassProperties('section', Section::class);
        }
    }
