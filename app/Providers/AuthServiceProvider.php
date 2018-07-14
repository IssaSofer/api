<?php

namespace App\Providers;

use Laravel\Passport\Passport;
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
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Passport::routes();
        Gate::define('kind', function ($corp) {
            if($corp->kind == 1){
                return true;
            }
            return false;
            
        });


        Gate::define('is_user', function ($user) {
            if($user->id == Auth()->user()->id){
                return true;
            }
            return false;
            
        });
        

        //
    }
}
