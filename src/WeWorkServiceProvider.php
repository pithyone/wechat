<?php

namespace WeWork;

use Illuminate\Support\ServiceProvider;

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

                $config = array_merge(
                    $wework['agents'][$wework['default']],
                    [
                        'corp_id' => $wework['corp_id'],
                        'logging' => [
                            'path'  => $wework['log']['file'],
                            'level' => $wework['log']['level'],
                        ],
                        'cache'   => [
                            'path' => $app['config']['cache.stores.file.path'],
                        ],
                    ]
                );

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
