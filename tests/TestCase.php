<?php

namespace RiseTechApps\ToUpper\Tests;

use Orchestra\Testbench\TestCase as OrchestraTestCase;
use RiseTechApps\ToUpper\ToUpperServiceProvider;

abstract class TestCase extends OrchestraTestCase
{
    protected function getPackageProviders($app)
    {
        return [ToUpperServiceProvider::class];
    }
}
