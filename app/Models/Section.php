<?php

    namespace App\Models;

    use App\User;
    use Illuminate\Database\Eloquent\Model;

    class Section extends Model {
        public $timestamps = false;
        protected $fillable = ['name'];
        protected $guarded = ['id'];
        protected $hidden = ['hidden'];

        public function phrases() {
            return $this->hasMany(Phrase::class);
        }

        public function user() {
            return $this->belongsTo(User::class);
        }

    }
