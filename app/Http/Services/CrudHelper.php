<?php

    namespace App\Services;

    use Illuminate\Pagination\LengthAwarePaginator;
    use Illuminate\Database\Eloquent\Model;
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

        public static function getPostTableButtons($resource, $models) {
            $buttons = [
                [
                    'title' => 'создать',
                    'route' => $resource . '.create'
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
                    'filter' => $resource
                ];
            }
            foreach ($models as $model) {
                $buttons[$model . '.index'] = [
                    'type' => 'child',
                    'title' => Str::lower(trans('crud.title.' . Str::lower($model))),
                    'route' => Str::lower($model) . '.index',
                    'filter' => $resource
                ];
            }
            return $buttons;
        }


    }
