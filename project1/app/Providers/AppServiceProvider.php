<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\GrantProject;
use App\Models\Academician;
use App\Models\Milestone;
use App\Policies\GrantProjectPolicy;
use App\Policies\AcademicianPolicy;
use App\Policies\MilestonePolicy;

class AppServiceProvider extends ServiceProvider
{
    
    protected $policies = [
        GrantProject::class => GrantProjectPolicy::class,
        Academician::class => AcademicianPolicy::class,
        Milestone::class => MilestonePolicy::class,
    ];
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //$this->registerPolicies();

        // Admin Gates
        Gate::define('manage-grant-projects', function ($user) {
            return $user->role === 'admin';
        });

        Gate::define('manage-academicians', function ($user) {
            return $user->role === 'admin';
        });

        // Staff Gates
        Gate::define('view-all-projects', function ($user) {
            return in_array($user->role, ['admin', 'staff']);
        });

        Gate::define('update-project-info', function ($user) {
            return in_array($user->role, ['admin', 'staff']);
        });

        // Project Leader Gates
        Gate::define('manage-own-project', function ($user, $project) {
            return $user->role === 'academician' && 
                   $project->project_leader_id === $user->academician->academician_id;
        });

        Gate::define('manage-milestones', function ($user, $project) {
            return $user->role === 'admin' || 
                   ($user->role === 'academician' && 
                    $project->project_leader_id === $user->academician->academician_id);
        });
    }
}
