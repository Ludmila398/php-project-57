<?php

namespace App\Providers;

use App\Models\Task;
use App\Policies\TaskPolicy;
use App\Models\Label;
use App\Policies\LabelPolicy;
use App\Models\TaskStatus;
use App\Policies\TaskStatusPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Task::class => TaskPolicy::class,
        TaskStatus::class => TaskStatusPolicy::class,
        Label::class => LabelPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
