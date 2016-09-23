<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        'App\Idea' => 'App\Policies\IdeaPolicy',
        'App\IdeaCategory' => 'App\Policies\IdeaCategoryPolicy',
        'App\User' => 'App\Policies\UserPolicy',
        'App\PartnerProgram' => 'App\Policies\PartnerProgramPolicy',
        'App\Project' => 'App\Policies\ProjectPolicy',
        'App\Note' => 'App\Policies\NotePolicy',
        'App\Content' => 'App\Policies\ContentPolicy',
        'App\Competition' => 'App\Policies\CompetitionPolicy',
        'App\Keyword' => 'App\Policies\KeywordPolicy',
        'App\Role' => 'App\Policies\RolePolicy',
        'App\Option' => 'App\Policies\OptionPolicy',
        'App\Backlink' => 'App\Policies\BacklinkPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
