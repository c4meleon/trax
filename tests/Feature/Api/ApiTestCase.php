<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\Passport\Passport;
use Tests\CreatesApplication;

abstract class ApiTestCase extends BaseTestCase
{
    use CreatesApplication;

    use DatabaseMigrations;

    public function userLogin()
    {
        Passport::actingAs(
            factory(\App\User::class)->create()
        );
    }
}
