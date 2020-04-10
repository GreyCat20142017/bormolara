<?php

    namespace App\Http\Controllers;

    use App\Components\FlashMessages;
    use App\Http\Requests\SectionRequest;
    use App\Models\Section;

    class SectionController extends Controller {

        use FlashMessages;

        protected $modelName = 'section';
        protected $childName = 'phrase';

        public function __construct() {
            $this->middleware('auth');
        }

        public function index() {
            $pageLimit = config()->offsetGet('constants.page_limit') ?? 10;
            $sections = Section::own()->paginate($pageLimit);
            return view('parent.list', [
                'rows' => $sections,
                'title' => 'Список курсов (фразы)',
                'modelName' =>  $this->modelName,
                'childName' => $this->childName
            ]);
        }

        public function create() {
            return view('parent.create', [
                'title' => 'Новый курс (фразы)',
                'modelName' => $this->modelName
            ]);
        }

        public function store(SectionRequest $request) {
            Section::create($request->all());
            return redirect()->route( $this->modelName . '.index');
        }


        public function show(Section $section) {
            return view('parent.show', [
                'title' => 'Просмотр элемента (курс Фразы)',
                'row' => $section,
                'modelName' => $this->modelName
            ]);
        }

        public function edit(Section $section) {
            $this->authorize('change',  $section);
            return view('parent.edit', [
                'title' => 'Изменение элемента (курс Фразы)',
                'modelName' =>  $this->modelName,
                'row' => $section
            ]);
        }

        public function update(SectionRequest $request, Section $section) {
            $section->update($request->all());
            static::message('success', 'Курс c id=' . $section->id . ' был изменен!');
            return redirect()->route( $this->modelName . '.index');
        }

        public function destroy(Section $section) {
            static::message('info', 'Курс c id=' . $section->id . ' ' . Str::upper($section->name) . ' был удален!');
            $section->delete();
            return back();
        }
    }
