<?php

namespace App\Providers;

use App\Models\Discount;
use App\Policies\DiscountPolicy;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Discount::class => DiscountPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define("admin-only", function($user){
            if( $user->role == "admin" && auth()->check() ){
                return Response::allow();
            }else{
                return Response::deny();
            }
        });

        //
    }
}
