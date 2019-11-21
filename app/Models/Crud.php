<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;


    /**
     * Class Crud. Псевдоабстрактный класс для попытки реализации упрощения создания ресурсных контроллеров и представлений.
     * Добавлять поля не рекомендуется.
     * Все дочерние модели должны иметь поле id.
     * @package App\Models
     */
    class Crud extends Model {

        protected static $childModels = [];

        public static function getChildModels() {
            return static::$childModels ?? [];
        }

        public static function getChildModelsCount() {
            return count(static::$childModels ?? 0);
        }

        public function parent() {
            return null;
        }

        public function scopeEnabled ($query) {
            return $query;
        }

        public function scopeOwn ($query) {
            return $query;
        }
    }
