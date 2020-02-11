<?php

namespace Mabadir\LaravelCypress\Tests\Unit;

use Route;
use Mabadir\LaravelCypress\Tests\TestCase;

class LaravelCypressServiceProviderUnitTest extends TestCase
{
    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function useCypress($app)
    {
        $app['config']->set('cypress.url', 'localhost');
        $app['config']->set('app.key', 'base64:c2Cqp/FpH9XBTqqryPGhbzHeb4nRh95l4eti3PfFJtE=');
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function useWithoutCypress($app)
    {
        $app['config']->set('cypress.url', 'acceptance.example.com');
        $app['config']->set('app.key', 'base64:c2Cqp/FpH9XBTqqryPGhbzHeb4nRh95l4eti3PfFJtE=');
    }

    /**
     * @test
     * @environment-setup useCypress
     */
    public function routes_are_added_for_acceptance()
    {
        $this->get('__testing__/create/User');

        $this->assertTrue(Route::has("testing.create.model"));
    }

    /**
     * @test
     * @environment-setup useWithoutCypress
     */
    public function routes_are_not_added_for_diff_env()
    {
        $this->get('__testing__/create/User');

        $this->assertFalse(Route::has("testing.create.model"));
    }
}