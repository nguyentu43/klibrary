<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\{ Book, Collection, Device, User };
use App\Policies\{ BookPolicy, CollectionPolicy, DevicePolicy, UserPolicy };

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Book::class => BookPolicy::class,
        Collection::class => CollectionPolicy::class,
        Device::class => DevicePolicy::class,
        User::class => UserPolicy::class
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
