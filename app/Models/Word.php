<?php

    namespace App\Models;
    use Illuminate\Database\Eloquent\Model;

    class Word extends Model {
        public $timestamps = false;
        protected $guarded = ['id'];
        protected $fillable = ['course_id', 'english', 'russian'];

        public function course() {
            return $this->belongsTo(Course::class);
        }


    }
