<?php

namespace MadeITBelgium\WordPress;

use Illuminate\Support\ServiceProvider;

/**
 * WordPress PHP SDK.
 *
 * @version    1.0.0
 *
 * @copyright  Copyright (c) 2018 Made I.T. (https://www.madeit.be)
 * @author     Tjebbe Lievens <tjebbe.lievens@madeit.be>
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-3.txt    LGPL
 */
class WordPressServiceProvider extends ServiceProvider
{
    protected $defer = false;

    protected $rules = [
    ];

    /**
     * Bootstrap the application events.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/wordpress.php' => config_path('wordpress.php'),
        ]);

        $this->loadTranslationsFrom(__DIR__.'/lang', 'wordpress');
        $this->addNewRules();
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->app->singleton('wordpress', function ($app) {
            $config = $app->make('config')->get('wordpress');

            return new WordPress($config['app_url']);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['wordpress'];
    }

    protected function addNewRules()
    {
        foreach ($this->rules as $rule) {
            $this->extendValidator($rule);
        }
    }

    protected function extendValidator($rule)
    {
        $method = 'validate'.studly_case($rule);
        $translation = $this->app['translator']->get('wordpress::validation');
        $this->app['validator']->extend($rule, 'MadeITBelgium\WordPress\Validation\ValidatorExtensions@'.$method, $translation[$rule]);
    }
}
