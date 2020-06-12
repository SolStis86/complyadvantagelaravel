<?php


namespace SolStis86\ComplyAdvantage;


use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use SolStis86\ComplyAdvantage\Validators\ComplyAdvantageParameterValidator;

class ComplyAdvantageServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Validator::extend('ca', ComplyAdvantageParameterValidator::class);

        $this->loadMigrationsFrom([
            __DIR__ . '/../migrations',
        ]);

        $this->publishes([
            __DIR__.'/../config/complyadvantage.php' => config_path('complyadvantage.php'),
        ]);

        $this->app->singleton(ApiClient::class, function () {
            return new ApiClient;
        });

        $this->app->singleton(WebHookEventProcessor::class, function () {
            return new WebHookEventProcessor;
        });
    }

    /**
     * Returns existing migration file if found, else uses the current timestamp.
     *
     * @param Filesystem $filesystem
     * @return string
     */
    protected function getMigrationFileName(Filesystem $filesystem): string
    {
        $timestamp = date('Y_m_d_His');

        return Collection::make($this->app->databasePath().DIRECTORY_SEPARATOR.'migrations'.DIRECTORY_SEPARATOR)
            ->flatMap(function ($path) use ($filesystem) {
                return $filesystem->glob($path.'*_create_ca_searches_table.php');
            })->push($this->app->databasePath()."/migrations/{$timestamp}_create_ca_searches_table.php")
            ->first();
    }
}
