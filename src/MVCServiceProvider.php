<?php

namespace AfrazAhmad\MVC;

use AfrazAhmad\MVC\CreateMVCCommand;
use Illuminate\Support\ServiceProvider;

class MVCServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if($this->app->runningInconsole()){
            $this->commands([CreateMVCCommand::class]);
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
