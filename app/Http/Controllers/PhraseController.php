<?php

    namespace App\Http\Controllers;

    use App\Models\Phrase;
    use App\Http\Requests\PhraseRequest;

    class PhraseController extends CrudController {

        public function __construct() {
            $this->fillClassProperties('phrase', Phrase::class, PhraseRequest::class);
        }
    }
