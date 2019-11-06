<?php

    namespace App\Models;

    class Phrase extends Crud {
        public $timestamps = false;
        protected $guarded = ['id'];
        protected $fillable = ['section_id', 'user_id', 'english', 'russian'];
        protected static $childModels = [];

        public function section() {
            return $this->belongsTo(Section::class);
        }

        public function scopeEnabled ($query, $user_id, $data_user_id = 1) {
            $query->whereIn('user_id', [$user_id, $data_user_id]);
        }
    }
