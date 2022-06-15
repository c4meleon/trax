<?php

namespace Tests\Feature\Api;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tests\TestCase;

class TripShowTest extends ApiTestCase
{
    private $trips;

    protected function setUp(): void
    {
        parent::setUp();

        $this->trips = factory(\App\Trip::class, 5)->create();
    }

    public function test_it_returns_trips()
    {
        $this->userLogin();

        $response = $this->getJson('/api/trips');

        $response->assertStatus(200)
            ->assertJson(['data' => $this->trips->toArray()]);
    }

    public function test_it_return_unauthorized()
    {
        $response = $this->getJson('/api/trips');

        $response->assertStatus(401);
    }
}
