<?php

    namespace App\Http\Controllers;

    use App\Models\Phrase;

    class PhraseController extends CrudController {

        public function __construct() {
            $this->fillClassProperties('phrase', Phrase::class);
        }
    }
