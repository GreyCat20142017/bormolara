<?php

    namespace App\Models;

    class Word extends Crud {
        public $timestamps = false;
        protected $guarded = ['id'];
        protected $hidden = ['course_id', 'user_id'];
        protected $fillable = ['course_id', 'user_id', 'english', 'russian'];
        protected static $childModels = [];

        protected $attributes = [
            'course_id' => 1,
            'user_id' => 1
        ];

        public function course() {
            return $this->belongsTo(Course::class);
        }

        public function parent() {
            return $this->belongsTo(Course::class);
        }

        public function scopeEnabled($query) {
            return $query->whereIn('user_id', [auth()->id(), config()->offsetGet('constants.data_user_id')]);
        }

        public function scopeOwn($query) {
            return $query->whereIn('user_id', [auth()->id()]);
        }
    }
