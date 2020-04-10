<?php

    namespace App\Http\Controllers;

    use App\Components\FlashMessages;
    use App\Models\Course;
    use App\Http\Requests\CourseRequest;
    use Illuminate\Support\Str;

    class CourseController extends Controller {

        use FlashMessages;

        protected $modelName = 'course';
        protected $childName = 'word';

        public function __construct() {
            $this->middleware('auth');
        }

        public function index() {
            $pageLimit = config()->offsetGet('constants.page_limit') ?? 10;
            $courses = Course::own()->paginate($pageLimit);
            return view('parent.list', [
                'rows' => $courses,
                'title' => 'Список курсов (слова)',
                'modelName' => $this->modelName,
                'childName' => $this->childName
            ]);
        }

        public function create() {
            return view('parent.create', [
                'title' => 'Новый курс (слова)',
                'modelName' => $this->modelName
            ]);
        }

        public function store(CourseRequest $request) {
            $course = Course::create($request->all());
            static::message('success', 'Создан курс c id=' . $course->id . ' : ' . $course->name);
            return redirect()->route($this->modelName . '.index');
        }


        public function show(Course $course) {
            return view('parent.show', [
                'title' => 'Просмотр элемента Курс (слова)',
                'modelName' => $this->modelName,
                'row' => $course
            ]);
        }

        public function edit(Course $course) {
            $this->authorize('change',  $course);
            return view('parent.edit', [
                'title' => 'Изменение элемента Курс (слова)',
                'modelName' => $this->modelName,
                'row' => $course
            ]);
        }

        public function update(CourseRequest $request, Course $course) {
            $course->update($request->all());
            static::message('success', 'Курс c id=' . $course->id . ' был изменен!');
            return redirect()->route($this->modelName . '.index');
        }


        public function destroy(Course $course) {
            $this->authorize('change', $course);
            static::message('info', 'Курс c id=' . $course->id . ' ' . Str::upper($course->name) . ' был удален!');
            $course->delete();
            return back();
        }
    }
