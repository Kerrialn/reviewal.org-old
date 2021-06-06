<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    protected $listen = [
        \SocialiteProviders\Manager\SocialiteWasCalled::class => [
            'SocialiteProviders\\Facebook\\FacebookExtendSocialite@handle',
        ],
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
