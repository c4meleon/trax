<?php

namespace Tests\Feature\Api;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tests\TestCase;

class CarShowTest extends ApiTestCase
{
    private $car;

    protected function setUp(): void
    {
        parent::setUp();

        $this->car = factory(\App\Car::class)->create();
        $trip = factory(\App\Trip::class)->make();

        $this->car->trips()->save($trip);
    }


    public function test_it_return_one_car()
    {
        $this->userLogin();
        $response = $this->getJson("/api/cars/{$this->car->id}");
        $response->assertStatus(200)
        ->assertJson([
            'data' => $this->car->toArray()
        ]);
    }

    public function test_it_returns_cars()
    {
        $this->userLogin();

        $response = $this->getJson('/api/cars');

        $response->assertStatus(200)
            ->assertJson([
                'data' => [$this->car->toArray()]]
            );
    }

    public function test_it_return_unauthorized()
    {
        $response = $this->getJson('/api/cars');

        $response->assertStatus(401);
    }
}
