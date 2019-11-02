<?php

    namespace App\Http\Controllers;
    use Illuminate\Support\Facades\App;
    use Illuminate\Http\Request;
    use App\Repositories\RepositoryFactory;
    use App\Models\Crud as CrudModel;
    use App\Services\GCHelper;

    abstract class CrudController extends Controller {

        protected $resource;
        protected $model;

        public function __construct($modelName) {
            $this->middleware('auth');
            $this->model = App::make($modelName);
            $this->resource = $modelName;
        }

        public function index(Request $request) {
            $limit = intval(config()->offsetGet('constants.min_records_limit') ?? 10);

            $rows = $this->model::paginate($limit);

            return view('reusable.pagination_table', [
                'rows' => $rows,
                'title' => 'Список',
                'fields' => GCHelper::getPaginatorFields($rows),
                'tableButtons' => GCHelper::$TableButtons,
                'postTableButtons' => GCHelper::$PostTableButtons,
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
            return view('reusable.element', [
                'method' => 'POST',
                'action' => 'store',
                'resource' => $this->resource,
                'readonly' => false,
                'row' => $row,
                'fields' => $row->getFillable()
            ]);
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
            return view('reusable.element', [
                'method' => 'GET',
                'action' => 'show',
                'readonly' => true,
                'needParam' => true,
                'row' => $row,
                'fields' => GCHelper::getAvailableFields($row),
                'resource' => $this->resource
            ]);
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param Course $row
         * @return \Illuminate\Http\Response
         */
        public function edit($id) {
            $row = $this->model::findOrFail($id);
            return view('reusable.element', [
                'method' => 'POST',
                'submethod' => 'PATCH',
                'action' => 'update',
                'resource' => $this->resource,
                'needParam' => true,
                'readonly' => false,
                'row' => $row,
                'fields' => GCHelper::getAvailableFields($row)
            ]);

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

    }
