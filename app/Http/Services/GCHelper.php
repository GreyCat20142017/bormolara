<?php

    namespace App\Services;

    use Illuminate\Pagination\LengthAwarePaginator;
    use Illuminate\Database\Eloquent\Model;

    class GCHelper {

        public static $PostTableButtons = [
            'create' => [
                'title' => 'создать'
            ]
        ];

        public static $TableButtons = [
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
    }
