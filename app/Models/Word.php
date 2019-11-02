<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Word extends Model {
        public $timestamps = false;
        protected $guarded = ['id'];
        protected $fillable = ['section_id', 'user_id', 'english', 'russian'];

        public function course() {
            return $this->belongsTo(Course::class);
        }

        public function scopeEnabled($query, $user_id, $data_user_id = 1) {
            $query->whereIn('user_id', [$user_id, $data_user_id]);

        }
    }
