<?php


namespace SolStis86\ComplyAdvantage\Tests;


use Orchestra\Testbench\TestCase as OrchestraTestCase;
use SolStis86\ComplyAdvantage\ComplyAdvantageServiceProvider;

abstract class TestCase extends OrchestraTestCase
{
    public $runMigrations = false;

    protected function setUp(): void
    {
        parent::setUp();

        if ($this->runMigrations) {
            include_once __DIR__.'/../database/migrations/create_ca_searches_table.php.stub';

            (new \CreateCASearchesTables())->up();
        }
    }

    protected function getEnvironmentSetUp($app)
    {
        parent::getEnvironmentSetUp($app);

        $app['config']->set('complyadvantage.api_key', 'DUMMYKEY');
        $app['config']->set('complyadvantage.database.searches_table_name', 'ca_searches');

        if ($this->runMigrations) {
            $app['config']->set('database.default', 'testbench');
            $app['config']->set('database.connections.testbench', [
                'driver' => 'sqlite',
                'database' => ':memory:',
                'prefix' => '',
            ]);
        }
    }

    protected function getPackageProviders($app)
    {
        return [ComplyAdvantageServiceProvider::class];
    }
}
