<?php

namespace App\Providers;

use App\Models\Course;
use App\Models\Word;
use App\Models\Section;
use App\Models\Phrase;
use App\Policies\CoursePolicy;
use App\Policies\WordPolicy;
use App\Policies\SectionPolicy;
use App\Policies\PhrasePolicy;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Course::class => CoursePolicy::class,
        Word::class => WordPolicy::class,
        Section::class => SectionPolicy::class,
        Phrase::class => PhrasePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
