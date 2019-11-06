<?php

    namespace App\Http\Controllers;

    use App\Models\Crud;
    use Illuminate\Support\Facades\App;
    use Illuminate\Http\Request;
    use App\Repositories\RepositoryFactory;
    use App\Services\CrudHelper;

    abstract class CrudController extends Controller {

        protected $resource;
        protected $model;

        protected $indexView = 'crud.pagination_table';
        protected $elementView = 'crud.element';

        public function __construct($modelName) {
            $this->middleware('auth');
            $this->resource = $modelName;
            $this->model = App::make($modelName);
            $this->modelsChildren = [];
        }

        public function index(Request $request) {
            $limit = intval(config()->offsetGet('constants.min_records_limit') ?? 10);
            $query = $request->query();
            dump($query);
            if (count($query) > 0) {
                $rows = $this->model::where('course_id', 1)->paginate($limit);
            } else {
                $rows = $this->model::paginate($limit);
            }

            return view($this->indexView, [
                'rows' => $rows,
                'title' => trans('crud.title.' . $this->resource),
                'fields' => CrudHelper::getPaginatorFields($rows),
                'tableButtons' => CrudHelper::getTableButtons($this->resource, $this->modelsChildren),
                'postTableButtons' => CrudHelper::getPostTableButtons($this->resource, $this->modelsChildren),
                'resource' => $this->resource
            ]);
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create() {
            $row = new $this->model();
            return view($this->elementView, $this->getElementViewParams('store', $row));
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param \Illuminate\Http\Request $request
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request) {
            $this->model::create($request->all());
            return redirect()->route($this->resource . '.index');
        }

        /**
         * Display the specified resource.
         *
         * @param Course $row
         * @return \Illuminate\Http\Response
         */
        public function show($id) {
            $row = $this->model::findOrFail($id);
            return view($this->elementView, $this->getElementViewParams('show', $row));
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param Course $row
         * @return \Illuminate\Http\Response
         */
        public function edit($id) {
            $row = $this->model::findOrFail($id);
            return view($this->elementView, $this->getElementViewParams('update', $row));
        }

        /**
         * Update the specified resource in storage.
         *
         * @param \Illuminate\Http\Request $request
         * @param Course $row
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, $id) {
            $row = $this->model::findOrFail($id);
            $row->fill($request->input())->save();
            return redirect()->route($this->resource . '.index');
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param Course $row
         * @return \Illuminate\Http\Response
         */
        public function destroy($id) {
            $row = $this->model::findOrFail($id);
            $row->delete();
            return redirect()->route($this->resource . '.index');
        }

        /**
         * Возвращает параметры для представления в зависимости от метода контроллера
         */
        protected function getElementViewParams($action, $row) {
            $params = [
                'method' => 'GET',
                'action' => $action,
                'readonly' => true,
                'needParam' => true,
                'row' => $row,
                'fields' => CrudHelper::getAvailableFields($row),
                'resource' => $this->resource
            ];
            switch ($action) {
                case 'store':
                    {
                        $params['method'] = 'POST';
                        $params['readonly'] = false;
                        $params['fields'] = $row->getFillable();
                        break;
                    }
                case 'update':
                    {
                        $params['method'] = 'POST';
                        $params['submethod'] = 'PATCH';
                        $params['readonly'] = false;
                        $params['fields'] = $row->getFillable();
                        break;
                    }
                default:
            }
            return $params;
        }

    }
