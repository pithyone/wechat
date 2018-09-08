<?php

namespace WeWork\Laravel;

use Illuminate\Support\ServiceProvider;
use WeWork\App;

class WeWorkServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes(
            [
                __DIR__.'/config.php' => config_path('wework.php'),
            ]
        );
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            'wework',
            function ($app, $parameters) {
                $wework = array_merge($app['config']['wework'], $parameters);

                $agent = $wework['agents'][$wework['default']];

                $config = array_merge($agent, $wework);

                $config['log'] = LogBridge::class;

                $config['cache'] = CacheBridge::class;

                return new App($config);
            }
        );
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['wework'];
    }
}
