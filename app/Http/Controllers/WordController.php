<?php

    namespace App\Http\Controllers;

    use App\Models\Word;

    class WordController extends CrudController {

        public function __construct() {
            $this->fillClassProperties('word', Word::class);
        }
    }
