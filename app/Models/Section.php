<?php

    namespace App\Models;

    use App\User;
    use Illuminate\Support\Facades\Auth;
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
                $model->user_id = Auth::id();
            });
        }

        public function phrases() {
            return $this->hasMany(Phrase::class);
        }

        public function user() {
            return $this->belongsTo(User::class);
        }

        public function scopeEnabled($query) {
            return $query->whereIn('user_id', [Auth::id(), config()->offsetGet('constants.data_user_id')]);
        }

        public function scopeOwn($query) {
            return $query->whereIn('user_id', [Auth::id()]);
        }

        public static function enabledOnly() {
            return Section::whereIn('user_id', [Auth::id(), config()->offsetGet('constants.data_user_id')]);
        }

        public function phrasesByLesson($lesson) {
            $pagination_step = config()->offsetGet('constants.phrases_limit');
            $offset = ($lesson - 1) * $pagination_step;
            return $this->phrases()->orderBy('section_id', 'ASC')->orderBy('id',
                'ASC')->limit($pagination_step)->offset($offset)->get();
        }

        public function phrasesForOffline($lesson) {
            $pagination_step = config()->offsetGet('constants.phrases_limit');
            $offline_limit = config()->offsetGet('constants.phrases_for_offline');
            $offset = ($lesson - 1) * $pagination_step;
            return $this->phrases()>orderBy('section_id', 'ASC')->orderBy('id',
                    'ASC')->limit($offline_limit)->offset($offset)->get();
        }

        public static function enabledSectionsInfo() {
            $sections = Section::enabledOnly()->select('id', 'name', 'user_id')->whereHas('phrases')->withCount('phrases')->get();
            $limit = config()->offsetGet('constants.phrases_limit') ?? 7;
            foreach ($sections as $course) {
                $course['lastlesson'] = intval(ceil($course['phrases_count'] / $limit));
            }
            return $sections;
        }
    }
