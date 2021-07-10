<?php

namespace Laravel\Nova\Tests;

abstract class PostgresIntegrationTest extends IntegrationTest
{
    protected function skipIfNotRunning()
    {
        if (! filter_var(getenv('RUN_POSTGRES_TESTS'), FILTER_VALIDATE_BOOLEAN)) {
            $this->markTestSkipped('Postgres tests not enabled.');

            return;
        }
    }

    /**
     * Load the migrations for the test environment.
     *
     * @return void
     */
    protected function loadMigrations()
    {
        $this->loadMigrationsFrom([
            '--database' => 'pgsql',
            '--path' => realpath(__DIR__.'/Migrations'),
            '--realpath' => true,
        ]);
    }

    /**
     * Define environment.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'pgsql');

        $app['config']->set('database.connections.pgsql', [
            'driver' => 'pgsql',
            'host' => '127.0.0.1',
            'port' => 5432,
            'database' => $_ENV['POSTGRES_DATABASE'] ?? 'nova_test',
            'username' => $_ENV['POSTGRES_USERNAME'] ?? 'taylor',
            'password' => '',
            'charset' => 'utf8',
            'prefix' => '',
            'schema' => 'public',
            'sslmode' => 'prefer',
        ]);
    }
}
