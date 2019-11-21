<?php

    namespace App\Http\Controllers;

    use App\Http\Requests\WordRequest;
    use App\Models\Word;
    use Illuminate\Http\Request as CrudRequest;

    class WordController extends CrudController {

        public function __construct() {
            $this->fillClassProperties('word', Word::class, WordRequest::class);
        }

        /**
         * @param CrudRequest $request
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
         * Переопределение родительского метода Create. Все пользователи, кроме datauser могут создавать
         * новые элементы только в разделе own
         */
        public function create(CrudRequest $request) {
            $courseId = (auth()->id() === config()->offsetGet('constants.data_user_id')) ?
                $request->input('course_id') : config()->offsetGet('constants.own_course_id');
            $row = new $this->model();
            $row->fill($request->query());
            $row->user_id = auth()->user()->id;
            $row->course_id = $courseId;
            return view($this->elementView, $this->getElementViewParams('store', $row));
        }

    }
