<?php

    namespace App\Http\Controllers\API;

    use App\Http\Controllers\Controller;
    use App\Models\Phrase;
    use App\Models\Word;
    use Illuminate\Http\Request;

    class SearchController extends Controller {

        public function searchWords(Request $request) {
            if ($request->has(['word', 'exact'])) {
                $word = trim($request->get('word'));
                return Word::searchExact($word)->get()->toArray();
            } elseif ($request->has('word')) {
                $word = trim($request->get('word'));
                return Word::search($word)->get()->toArray();
            }
            return [];
        }

        public function searchPhrases(Request $request) {
            if ($request->has(['phrase', 'exact'])) {
                $phrase = trim($request->get('phrase'));
                return Phrase::searchExact($phrase)->get()->toArray();
            } elseif ($request->has('phrase')) {
                $phrase = trim($request->get('phrase'));
                return Phrase::search($phrase)->get()->toArray();
            }
            return [];
        }

    }
