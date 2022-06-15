<?php

namespace App\Http\Controllers\API;

use App\Car;
use App\Http\Requests\StoreCarRequest;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;

class CarController extends ApiController
{
    public function index(): JsonResponse
    {
        return $this->response(Car::all());
    }

    public function store(StoreCarRequest $request): JsonResponse
    {
        try {
            $car = Car::create($request->all());
            return $this->response($car);
        } catch (QueryException $exception) {
            return $this->responseError($exception->getMessage());
        }
    }

    public function show(Car $car): JsonResponse
    {
        return $this->response($car);
    }

    public function destroy(Car $car): JsonResponse
    {
        try {
            $car->delete();
            return $this->responseSuccess();
        } catch (\Exception $exception) {
            return $this->responseError($exception->getMessage());
        }
    }
}
