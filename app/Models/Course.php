<?php

    namespace App\Models;

    use App\User;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Facades\Auth;

    class Course extends Model {

        public $timestamps = false;
        protected $fillable = ['name'];
        protected $hidden = ['hidden'];

        public static function boot() {
            parent::boot();
            self::creating(function ($model) {
                $model->user_id = Auth::id();
            });
        }

        public function words() {
            return $this->hasMany(Word::class);
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
            return Course::whereIn('user_id', [Auth::id(), config()->offsetGet('constants.data_user_id')]);
        }

        public function wordsByLesson($lesson) {
            $pagination_step = config()->offsetGet('constants.words_limit');
            $offset = ($lesson - 1) * $pagination_step;
            return $this->words()->orderBy('course_id', 'ASC')->orderBy('id',
                'ASC')->limit($pagination_step)->offset($offset)->get();
        }

        public function wordsForOffline($lesson) {
            $pagination_step = config()->offsetGet('constants.words_limit');
            $offline_limit = config()->offsetGet('constants.words_for_offline');
            $offset = ($lesson - 1) * $pagination_step;
            return $this->words()->orderBy('course_id', 'ASC')->orderBy('id',
                'ASC')->limit($offline_limit)->offset($offset)->get();
        }

        public static function enabledCoursesInfo() {
            $courses = Course::enabledOnly()->select('id', 'name', 'user_id')->withCount('words')->get();
            $limit = config()->offsetGet('constants.words_limit') ?? 20;
            foreach ($courses as $course) {
                $course['lastlesson'] = intval(ceil($course['words_count'] / $limit));
            }
            return $courses;
        }
    }

