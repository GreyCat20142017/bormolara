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
    }
