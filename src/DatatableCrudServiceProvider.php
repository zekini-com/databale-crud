<?php
namespace Zekini\DatatableCrud;


use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

use Zekini\DatatableCrud\Mixins\StrMixin;


class DatatableCrudServiceProvider extends ServiceProvider
{
     /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        // my custom str mixin
        Str::mixin(new StrMixin);

        $this->registerCommands();

        $this->loadViewsFrom(__DIR__.'/../stubs', 'zekini/stubs');

        $this->app['view']->addNamespace('zekini/livewire-crud-generator', resource_path('views/vendor/zekini'));

        // register commands
        if ($this->app->runningInConsole()) {
           $this->publishConfig();
        }

    }

    /**
     * Registers Command
     *
     * @return void
     */
    protected function registerCommands()
    {
        $this->commands([

        ]);
    }

    /**
     * publishConfig
     *
     * @return void
     */
    protected function publishConfig()
    {
        $this->publishes([
            __DIR__ . '/../config/datatable-crud.php' => config_path('datatable-crud.php'),
        ], 'config');
    }



    public function register()
    {

    }
}
