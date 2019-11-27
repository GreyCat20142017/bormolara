<?php

    namespace App\Models;

    use App\User;
    use App\Models\Phrase;
    use Illuminate\Database\Eloquent\Model;

    class Section extends Model {
        public $timestamps = false;
        protected $fillable = ['name'];
        protected $guarded = ['id'];
        protected $hidden = ['hidden'];

        public static function boot()
        {
            parent::boot();
            self::creating(function ($model) {
                $model->user_id = auth()->id();
            });
        }

        public function phrases() {
            return $this->hasMany(Phrase::class);
        }

        public function user() {
            return $this->belongsTo(User::class);
        }

        public function scopeEnabled($query) {
            return $query->whereIn('user_id', [auth()->id(), config()->offsetGet('constants.data_user_id')]);
        }

        public function scopeOwn($query) {
            return $query->whereIn('user_id', [auth()->id()]);
        }

    }
