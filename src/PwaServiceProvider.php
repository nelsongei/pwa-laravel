<?php

namespace LdTalent\Pwa;

use Illuminate\Support\ServiceProvider;

use LdTalent\Pwa\Commands\PublishPwaAssets;

class PwaServiceProvider extends ServiceProvider
{
	
	/**
     * Bootstrap the application services.
     *
     * @return void
     */
	public function boot()
	{

	}

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

        /** Here we are restricting the instantiation of a class to a single object. 
         * This is useful when only one object is required across the entire system
        */
    	$this->app->singleton('pwa-laravel:publish', function ($app) {
    		return new PublishPwaAssets();
    	});

        /** Add the list of commands registered into the commands array for 
         * access in the artisan console.
         * */
    	$this->commands([
    		'pwa-laravel:publish',
    	]);
    }

}