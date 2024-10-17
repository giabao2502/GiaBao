<?php

namespace App\Providers;


use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Customer;
use App\Models\Comment;
use App\Policies\CommentPolicy;


class AuthServiceProvider extends ServiceProvider
{
    // /**
    //  * The policy mappings for the application.
    //  *
    //  * @var array<class-string, class-string>
    //  */
    // protected $policies = [
    //     // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    // ];

    // /**
    //  * Register any application services.
    //  */
    // public function register(): void
    // {
    //     //
    // }

    // /**
    //  * Bootstrap any application services.
    //  */
    // public function boot(): void
    // {
    //     $this->registerPolicies();

    //     Gate::define('change-comment', function (Customer $customer, Comment $comment) {
    //         return $customer->id === $comment->customer_id;
    //     });
    // }

    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\Customer' => 'App\Policies\CustomerPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('change-comment', [CommentPolicy::class, 'changeComment']);
    }
}
