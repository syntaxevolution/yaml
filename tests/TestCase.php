<?php

namespace SyntaxEvolution\Yaml\Tests;

use Orchestra\Testbench\TestCase as OrchestraTestCase;
use SyntaxEvolution\Yaml\Package\ServiceProvider as YamlServiceProvider;

abstract class TestCase extends OrchestraTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            YamlServiceProvider::class,
        ];
    }
}
