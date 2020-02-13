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

        public static function search($text) {
            return Word::where('english', 'like', '%' . $text . '%') ->orWhere('russian', 'like', '%' . $text . '%');
        }

        public static function searchExact($text) {
            return Word::where('english', '=', $text)->orWhere('russian', '=', $text);
        }
    }
