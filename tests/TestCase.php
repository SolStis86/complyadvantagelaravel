<?php


namespace SolStis86\ComplyAdvantage\Tests;


use Orchestra\Testbench\TestCase as OrchestraTestCase;
use SolStis86\ComplyAdvantage\ComplyAdvantageServiceProvider;

abstract class TestCase extends OrchestraTestCase
{
    protected function getEnvironmentSetUp($app)
    {
        parent::getEnvironmentSetUp($app);

        $app['config']->set('complyadvantage.api_key', 'DUMMYKEY');
    }

    protected function getPackageProviders($app)
    {
        return [ComplyAdvantageServiceProvider::class];
    }
}
