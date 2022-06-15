<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CarCreateTest extends ApiTestCase
{
    public function test_it_returns_car_on_successfully_creating_new_car()
    {
        $this->userLogin();

        $requestData = [
            'year' => 2022,
            'make' => "BMW",
            'model' => "M5"
        ];

        $response = $this->postJson('/api/cars', $requestData);

        $response->assertStatus(200)
            ->assertJson([
                'data' => $requestData
            ]);
    }

    public function test_it_validation_fields_errors()
    {
        $this->userLogin();

        $requestData = [
            'year' => "wrong_string",
            'make' => "BMW",
            'model' => "M5"
        ];

        $response = $this->postJson('/api/cars', $requestData);

        $response->assertStatus(422)
            ->assertJson([
                'message' => "The given data was invalid.",
                'errors' => [
                    'year' => ['The year must be an integer.'],
                ]
            ]);
    }

    public function test_it_return_unauthorized()
    {
        $requestData = [
            'year' => "wrong_string",
            'make' => "BMW",
            'model' => "M5"
        ];

        $response = $this->postJson('/api/cars', $requestData);

        $response->assertStatus(401);
    }
}
