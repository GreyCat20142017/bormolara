<?php

    namespace App\Http\Controllers;

    use App\Components\FlashMessages;
    use Illuminate\Http\Request as CrudRequest;
    use App\Repositories\RepositoryFactory;
    use App\Services\CrudHelper;
    use App\Models\Crud;
    use Illuminate\Support\Facades\Validator;

    abstract class CrudController extends Controller {

        use FlashMessages;

        protected $resource;
        protected $model;
        protected $modelChildren;
        protected $modelFields;

        protected $indexView = 'crud.pagination_table';
        protected $elementView = 'crud.element';

         public function __construct($modelName) {
            fillClassProperties($modelName, Crud::class, FormRequest::class);
        }

        public function index(CrudRequest $request) {
            $limit = intval(config()->offsetGet('constants.min_records_limit') ?? 10);
            $query = CrudHelper::withoutPages($request->query());

            $rows  = $this->model::where($query)->own()->paginate($limit);

            return view($this->indexView, [
                'rows' => $rows,
                'title' => trans('crud.title.' . $this->resource),
                'fields' => CrudHelper::getPaginatorFields($rows),
                'tableButtons' => CrudHelper::getTableButtons($this->resource, $this->modelChildren, $query),
                'postTableButtons' => CrudHelper::getPostTableButtons($this->resource, $this->modelChildren),
                'resource' => $this->resource
            ]);
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create(CrudRequest $request) {
            $row = new $this->model();
            $row->fill($request->query());
            $row->user_id = auth()->user()->id;
            return view($this->elementView, $this->getElementViewParams('store', $row));
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param \Illuminate\Http\Request $request
         * @return \Illuminate\Http\Response
         */
        public function store(CrudRequest $request) {
            $this->crudValidate($request);
            $this->model::create($request->all());
            $params = app()->make($this->model)->parentQuery();
            return redirect()->route($this->resource . '.index', $params);
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
        public function edit(CrudRequest $request,$id) {
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
        public function update(CrudRequest $request, $id) {
            $this->crudValidate($request);
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
        public function destroy(CrudRequest $request, $id) {
            $row = $this->model::findOrFail($id);
            $row->delete();
            static::message('info', 'Запись с id=' .$id . ' была удалена!');
            return redirect()->route($this->resource . '.index');
        }

        /**
         * Валидирует данные в соответствии с правилами валидации переданного через конструктор FormRequest,
         * соответствующий модели, также переданной через конструктор
         */
        protected function crudValidate (CrudRequest $request) {
            $validator = Validator::make($request->all(), app()->make($this->request)->rules());
            if ($validator->fails()) {
                return redirect(back()->withErrors());
            }
            return true;
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

        /**
         * Заполняет свойства создаваемого экземпляра класса
         * @param String $modelName
         * @param CrudModel $model
         * @param FormRequest $request
         */
        protected function fillClassProperties($modelName, $model, $request) {
            $this->middleware('auth');
            $this->resource = $modelName;
            $this->model = $model;
            $this->request = $request;
            $this->modelChildren = $model::getChildModels();
            $this->modelFields = CrudHelper::getFieldsWithTypes($this->resource);
        }

    }
