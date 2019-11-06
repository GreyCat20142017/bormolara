<?php

    namespace App\Models;

    use App\User;

    class Section extends Crud {
        public $timestamps = false;
        protected $fillable = ['name'];
        protected $guarded = ['id'];
        protected $hidden = ['hidden'];
        protected static $childModels = ['Phrase'];

        public function phrases() {
            return $this->hasMany(Phrase::class);
        }

        public function user() {
            return $this->belongsTo(User::class);
        }

    }
