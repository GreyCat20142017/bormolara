<?php

    namespace App\Models;

    class Word extends Crud {
        public $timestamps = false;
        protected $guarded = ['id'];
        protected $hidden = ['course_id', 'user_id'];
        protected $fillable = ['course_id', 'user_id', 'english', 'russian'];
        protected static $childModels = [];

        public function course() {
            return $this->belongsTo(Course::class);
        }

        public function scopeEnabled($query, $user_id, $data_user_id = 1) {
            $query->whereIn('user_id', [$user_id, $data_user_id]);

        }
    }
