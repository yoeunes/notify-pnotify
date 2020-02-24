<?php

namespace Yoeunes\Notify\Pnotify;

use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Yoeunes\Notify\Laravel\Session\Session;
use Yoeunes\Notify\NotifyManager;
use Yoeunes\Notify\Pnotify\Factories\PnotifyFactory;

class NotifyPnotifyServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerPnotifyFactory();
    }

    public function registerPnotifyFactory()
    {
        $this->app->extend('notify', function (NotifyManager $manager, Application $app) {
            $session = $app['session'];

            $manager->extend('pnotify', function ($config) use ($session) {
                return new PnotifyFactory($config, new Session($session));
            });

            return $manager;
        });
    }
}
