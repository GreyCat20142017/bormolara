<?php

    namespace App\Models;

    use App\User;

    class Course extends Crud {

        public $timestamps = false;
        protected $fillable = ['name'];
        protected $hidden = ['hidden'];
        protected static $childModels = ['Word'];

        public function words() {
            return $this->hasMany(Word::class);
        }

        public function user() {
            return $this->belongsTo(User::class);
        }
    }

