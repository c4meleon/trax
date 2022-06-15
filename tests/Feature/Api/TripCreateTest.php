<?php

namespace Tests\Feature\Api;

use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TripCreateTest extends ApiTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->car = factory(\App\Car::class)->create();
    }

    public function test_it_returns_car_on_successfully_creating_new_car()
    {
        $this->userLogin();

        $requestData = [
            'car_id' => $this->car->id,
            'date' => Carbon::now()->subDays(1)->format('m/d/Y'),
            'miles' => 123
        ];

        $response = $this->postJson('/api/trips', $requestData);

        $response->assertStatus(200)
            ->assertJson([
                'data' => $requestData
            ]);
    }

    public function test_it_validation_car_id()
    {
        $this->userLogin();

        $requestData = [
            'car_id' => 9999,
            'date' => Carbon::now(),
            'miles' => 123
        ];

        $response = $this->postJson('/api/trips', $requestData);

        $response->assertStatus(422)
            ->assertJson([
                'message' => "The given data was invalid.",
                'errors' => [
                    'car_id' => ['The selected car id is invalid.'],
                ]
            ]);
    }

    public function test_it_return_unauthorized()
    {
        $response = $this->postJson('/api/trips', []);

        $response->assertStatus(401);
    }
}
