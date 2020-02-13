<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Phrase extends Model    {
        public $timestamps = false;
        protected $guarded = ['id'];
        protected $fillable = ['section_id',  'english', 'russian'];

        public function section() {
            return $this->belongsTo(Section::class);
        }

        public static function search($text) {
            return Phrase::where('english', 'like', '%' . $text . '%') ->orWhere('russian', 'like', '%' . $text . '%');
        }

        public static function searchExact($text) {
            return Phrase::where('english', '=', $text)->orWhere('russian', '=', $text);
        }
    }
