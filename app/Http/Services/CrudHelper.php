<?php

    namespace App\Services;

    use Illuminate\Pagination\LengthAwarePaginator;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Str;

    class CrudHelper {

        protected static $TableButtons = [
            'show' => ['title' => 'просмотреть'],
            'edit' => ['title' => 'изменить'],
            'destroy' => [
                'title' => 'удалить'
            ]
        ];

        public static function getPaginatorFields(LengthAwarePaginator $paginator) {
            $headers = [];
            $items = $paginator->items();
            if (count($items) > 0) {
                $fields = $items[0]->toArray();
                foreach ($fields as $fieldName => $field) {
                    $headers[] = $fieldName;
                }
            }
            return $headers;
        }

        public static function getFieldsWithTypes($resource) {
            $result = [];
            $tableName = Str::plural(Str::snake($resource));
            $builder = DB::getSchemaBuilder();
            $fields = $builder->getColumnListing($tableName);
            foreach ($fields as $field) {
                $result[$field] = $builder->getColumnType($tableName, $field);
            }
            return $result;
        }

        public static function getAvailableFields(Model $model) {
            $headers = [];
            $fields = $model->attributesToArray();
            if (count($fields) > 0) {
                foreach ($fields as $fieldName => $field) {
                    $headers[] = $fieldName;
                }
            }
            return $headers;
        }

        public static function getPostTableButtons($resource) {
            $buttons = [
                [
                    'title' => 'создать',
                    'route' => $resource . '.create'
                ],
                [
                    'title' => 'домой',
                    'route' => 'home'
                ],
                [
                    'title' => 'на главную',
                    'route' => 'main'
                ]
            ];
            return $buttons;
        }

        public static function getTableButtons($resource, $models) {
            $buttons = [];
            foreach (static::$TableButtons as $buttonKey => $button) {
                $buttons[] = [
                    'type' => $buttonKey,
                    'title' => $button['title'],
                    'route' => $resource . '.' . $buttonKey,
                    'filter' => ($resource . '_id')
                ];
            }
            foreach ($models as $model) {
                $buttons[$model . '.index'] = [
                    'type' => 'child',
                    'title' => Str::lower(trans('crud.title.' . Str::lower($model))),
                    'route' => Str::lower($model) . '.index',
                    'filter' => ($resource . '_id')
                ];
            }
            return $buttons;
        }


        public static function withoutPages($params) {
            $query = [];
            foreach ($params as $key => $value) {
                if ($key !== 'page') {
                    $query[] = [$key => $value];
                }
            }
            return count($query) > 0 ? [$query] : [];
        }

    }
