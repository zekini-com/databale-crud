<?php
namespace Zekini\DatatableCrud;


use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Zekini\DatatableCrud\Commands\Generators\GenerateCreateModal;
use Zekini\DatatableCrud\Commands\Generators\GenerateCreateModalView;
use Zekini\DatatableCrud\Commands\Generators\GenerateDatatableComponent;
use Zekini\DatatableCrud\Commands\Generators\GenerateDatatableTest;
use Zekini\DatatableCrud\Commands\Generators\GenerateEditModal;
use Zekini\DatatableCrud\Commands\Generators\GenerateEditModalView;
use Zekini\DatatableCrud\Commands\Generators\GenerateExport;
use Zekini\DatatableCrud\Commands\Generators\GenerateForm;
use Zekini\DatatableCrud\Commands\Generators\GenerateImport;
use Zekini\DatatableCrud\Commands\Generators\GenerateIndexComponent;
use Zekini\DatatableCrud\Commands\Generators\GenerateIndexTest;
use Zekini\DatatableCrud\Commands\Generators\GenerateIndexView;
use Zekini\DatatableCrud\Commands\Generators\GenerateRoutes;
use Zekini\DatatableCrud\Commands\Generators\GenerateTableActions;
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
            GenerateExport::class,
            GenerateForm::class,
            GenerateDatatableTest::class,
            GenerateIndexTest::class,
            GenerateIndexComponent::class,
            GenerateIndexView::class,
            GenerateRoutes::class,
            GenerateCreateModal::class,
            GenerateEditModal::class,
            GenerateIndexView::class,
            GenerateEditModalView::class,
            GenerateCreateModalView::class,
            GenerateTableActions::class
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
