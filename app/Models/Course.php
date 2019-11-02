<?php

    namespace App\Models;

    use App\User;
    use Illuminate\Database\Eloquent\Model;

    class Course extends Model {

        public $timestamps = false;
        protected $fillable = ['name'];
        protected $hidden = ['hidden'];

        public function words() {
            return $this->hasMany(Word::class);
        }

        public function user() {
            return $this->belongsTo(User::class);
        }


    }
