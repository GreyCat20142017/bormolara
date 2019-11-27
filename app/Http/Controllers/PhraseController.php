<?php

    namespace App\Http\Controllers;

    use App\Models\Phrase;
    use App\Http\Requests\PhraseRequest;
    use App\Models\Section;
    use Illuminate\Support\Str;
    use App\Components\FlashMessages;

    class PhraseController extends Controller {

        use FlashMessages;

        protected $parentName = 'section';
        protected $modelName = 'phrase';

        public function __construct() {
            $this->middleware('auth');
        }

        public function indexByParent(Section $section) {
            $pageLimit = config()->offsetGet('constants.page_limit') ?? 10;
            $rows = $section->phrases()->paginate($pageLimit);
            return view('child.list', [
                'rows' => $rows,
                'title' => 'Список слов курса '  . trans('signs.leftArrow'). Str::upper($section->name) . trans('signs.rightArrow'),
                'modelName' => $this->modelName,
                'parentName' => $this->parentName,
                'parent' => $section
            ]);
        }

        public function createByParent(Section $section) {
            if ($this->canAdd($section)) {
                static::message('warning', 'Нельзя добавлять контент в чужие курсы!');
                return back();
            }
            return view('child.create', [
                'title' => 'Новый элемент (слово)',
                'modelName' => $this->modelName,
                'parentName' => $this->parentName,
                'parent' => $section
            ]);
        }

        public function storeByParent(PhraseRequest $request, Section $section) {
            $phrase = $section->phrases()->create($request->all());
            static::message('success', 'Добавлена фраза c id=' . $phrase->id . ' (' . $phrase->english . ')!');
            return redirect()->route($this->modelName . '.indexByParent', [$this->parentName => $section]);
        }

        public function show(Phrase $phrase) {
            return view('child.show', [
                'title' => 'Просмотр элемента (слово)',
                'modelName' => $this->modelName,
                'row' => $phrase
            ]);
        }

        public function edit(Phrase $phrase) {
            $this->authorize('change', $phrase);
            return view('child.edit', [
                'title' => 'Изменение элемента (слово)',
                'modelName' => $this->modelName,
                'row' => $phrase
            ]);
        }

        public function update(PhraseRequest $request, Phrase $phrase) {
            $phrase->update($request->all());
            static::message('success', 'Слово c id=' . $phrase->id . ' (' . $phrase->english . ')  было изменено!');
            $section = $phrase->course()->get()->first();
            return redirect()->route($this->modelName . '.indexByParent', [$this->parentName => $section]);
        }

        public function destroy(Phrase $phrase) {
            $this->authorize('change', $phrase);
            static::message('info', 'Слово c id=' . $phrase->id . ' (' . $phrase->english . ')  было удалено!');
            $phrase->delete();
            return back();
        }

        protected function canAdd(Phrase $phrase) {
            $id = auth()->id();
            return ($id === $phrase->user_id);
        }

    }
