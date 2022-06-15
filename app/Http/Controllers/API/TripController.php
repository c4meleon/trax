<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\StoreTripRequest;
use App\Trip;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;

class TripController extends ApiController
{
    public function index(): JsonResponse
    {
        return $this->response(Trip::with('car')->get());
    }

    public function store(StoreTripRequest $request): JsonResponse
    {
        try {
            $total = Trip::where('car_id', $request->input('car_id'))->max('total');
            $trip = Trip::create(
                array_merge(
                    $request->all(),
                    ['total' => $total + (float) $request->input('miles')]
                )
            );

            return $this->response($trip);
        } catch (QueryException $exception) {
            return $this->responseError($exception->getMessage());
        }
    }
}
