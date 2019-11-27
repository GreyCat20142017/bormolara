<?php

    namespace App\Http\Controllers;

    use App\Components\FlashMessages;
    use App\Models\Course;
    use App\Models\Word;
    use App\Http\Requests\WordRequest;
    use Illuminate\Support\Str;

    class WordController extends Controller {

        use FlashMessages;

        protected $parentName = 'course';
        protected $modelName = 'word';

        public function __construct() {
            $this->middleware('auth');
        }

        public function indexByParent(Course $course) {
            $pageLimit = config()->offsetGet('constants.page_limit') ?? 10;
            $rows = $course->words()->paginate($pageLimit);
            return view('child.list', [
                'rows' => $rows,
                'title' => 'Список слов курса ' . (isset($course) ? Str::upper($course->name) : ''),
                'modelName' => $this->modelName,
                'parentName' => $this->parentName,
                'parent' => $course
            ]);
        }

        public function createByParent(Course $course) {
            if (!$this->canAdd($course)) {
                static::message('warning', 'Нельзя добавлять контент в чужие курсы!');
                return back();
            }
            return view('child.create', [
                'title' => 'Новый элемент (слово)',
                'modelName' => $this->modelName,
                'parentName' => $this->parentName,
                'parent' => $course
            ]);
        }

        public function storeByParent(WordRequest $request, Course $course) {
            $backRoute = $request->has('saveAndRepeat') ? '.createByParent' : '.indexByParent';
            $word = $course->words()->create($request->all());
            static::message('success', 'Добавлено слово c id=' . $word->id . ' (' . $word->english . ')!');
            return redirect()->route($this->modelName . $backRoute, [$this->parentName => $course]);
        }

        public function show(Word $word) {
            return view('child.show', [
                'title' => 'Просмотр элемента (слово)',
                'modelName' => $this->modelName,
                'row' => $word
            ]);
        }

        public function edit(Word $word) {
            $this->authorize('change', $word);
            return view('child.edit', [
                'title' => 'Изменение элемента (слово)',
                'modelName' => $this->modelName,
                'row' => $word
            ]);
        }

        public function update(WordRequest $request, Word $word) {
            $word->update($request->all());
            static::message('success', 'Слово c id=' . $word->id . ' (' . $word->english . ')  было изменено!');
            $course = $word->course()->get()->first();
            return redirect()->route($this->modelName . '.indexByParent', [$this->parentName => $course]);
        }

        public function destroy(Word $word) {
            $this->authorize('change', $word);
            static::message('info', 'Слово c id=' . $word->id . ' (' . $word->english . ')  было удалено!');
            $word->delete();
            return back();
        }

        protected function canAdd(Course $course) {
            $id = auth()->id();
            return ($id === $course->user_id);
        }
    }
