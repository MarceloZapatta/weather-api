<?php

namespace App\Http\Controllers;

use App\Exceptions\LocationUserAlreadyExistsException;
use App\Exceptions\UnableToFetchWeatherNewLocationException;
use App\Http\Requests\LocationUserRequest;
use App\Http\Resources\LocationResource;
use App\Models\Location;
use App\Models\User;
use App\Services\LocationUsersService;
use Illuminate\Http\Response;

class LocationUserController extends Controller
{
    public function __construct(public LocationUsersService $locationUsersService) {}

    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $locations = $this->locationUsersService->getUserLocations();

        return LocationResource::collection($locations);
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(LocationUserRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            $location = $this->locationUsersService->storeUserLocation($request->country, $request->city);
        } catch (UnableToFetchWeatherNewLocationException $th) {
            return response()->json([
                'message' => 'Unable to fetch weather data for this location.'
            ], Response::HTTP_BAD_REQUEST);
        } catch (LocationUserAlreadyExistsException $th) {
            return response()->json([
                'message' => 'User location already exists'
            ], Response::HTTP_BAD_REQUEST);
        }

        return response()->json([
            'message' => 'Location created successfully',
            'location' => new LocationResource($location)
        ], Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Location $location): \Illuminate\Http\JsonResponse
    {
        $this->locationUsersService->deleteUserLocation($location);

        return response()->json([
            'message' => 'Location deleted successfully'
        ]);
    }
}
