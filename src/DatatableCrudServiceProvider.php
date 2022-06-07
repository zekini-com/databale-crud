<?php
namespace Zekini\DatatableCrud;


use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Zekini\DatatableCrud\Commands\Generators\GenerateDatatableComponent;
use Zekini\DatatableCrud\Commands\Generators\GenerateExport;
use Zekini\DatatableCrud\Commands\Generators\GenerateImport;
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

        $this->loadViewsFrom(__DIR__.'/../stubs', 'zekini/datatable-stubs');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'zekini/datatable-crud');

        //$this->app['view']->addNamespace('zekini/datatable-crud', resource_path('views/vendor/zekini-datatable-crud'));

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
            GenerateDatatableComponent::class,
            GenerateImport::class,
            GenerateExport::class
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
