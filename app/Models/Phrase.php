<?php

    namespace App\Models;

    class Phrase extends Crud {
        public $timestamps = false;
        protected $guarded = ['id'];
        protected $fillable = ['section_id', 'user_id', 'english', 'russian'];
        protected $hidden = ['section_id', 'user_id'];
        protected static $childModels = [];

        protected $attributes = [
            'section_id' => 1,
            'user_id' => 1
        ];

        public function section() {
            return $this->belongsTo(Section::class);
        }

        public function parentQuery() {
            return $this->belongsTo(Section::class)->getParent()->attributes;
        }

        public function scopeEnabled($query) {
            return $query->whereIn('user_id', [auth()->id(), config()->offsetGet('constants.data_user_id')]);
        }

        public function scopeOwn($query) {
            return $query->whereIn('user_id', [auth()->id()]);
        }

    }
