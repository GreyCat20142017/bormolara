<?php

    namespace App\Http\Controllers\API;

    use App\Http\Controllers\Controller;
    use App\Models\Section;
    use Illuminate\Http\Request;

    class SectionController extends Controller {

        public function sections(Request $request) {
            if ($request->has(['section', 'lesson', 'offline'])) {
                $section = Section::findOrFail(intval($request->get('section')));
                $lesson = intval($request->get('lesson'));
                return $section->phrasesForOffline($lesson)->toArray();
            } elseif ($request->has(['section', 'lesson'])) {
                $section = Section::findOrFail(intval($request->get('section')));
                $lesson = intval($request->get('lesson'));
                return $section->phrasesByLesson($lesson)->toArray();
            } else {
                return Section::enabledSectionsInfo()->toArray();
            }
        }
    }
