<?php

namespace App\Providers;
use App\Role;
use App\Http\Policies\RolePolicy;
use Illuminate\Support\Facades\Gate;
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
        Role::class => RolePolicy::class,
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
        Gate::define('view-blog', function ($user) {
            if($user->is_super OR $user->is_admin()) {
                return true;
            }
            return $user->hasAccess(['view-blog']);
        });
    }
}
