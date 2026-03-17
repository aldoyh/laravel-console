<?php

namespace Redberry\LaravelConsole;

use Illuminate\Support\Facades\Blade;
use Redberry\LaravelConsole\App\Logger;
use Illuminate\Support\ServiceProvider as SupportServiceProvider;

class ServiceProvider extends SupportServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton('laravel-console.logger', fn () => new Logger());
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/routes.php');

        /**
         * Log a single value passed as the directive expression.
         */
        Blade::directive('log', function (string $expression): string {
            return "<?php console()->log({$expression}); ?>";
        });

        /**
         * Log all variables available in the current view scope.
         */
        Blade::directive('explain', function (): string {
            return '<?php
                $__consoleViewData = array_diff_key($__data ?? [], array_flip(["__env", "app", "errors"]));
                console()->log($__consoleViewData);
                unset($__consoleViewData);
            ?>';
        });
    }
}
