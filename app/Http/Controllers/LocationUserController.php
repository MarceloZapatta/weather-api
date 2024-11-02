<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocationUserRequest;
use App\Http\Resources\LocationResource;
use App\Models\LocationUser;
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
        $location = $this->locationUsersService->storeUserLocation($request->country, $request->city);

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
    public function destroy(LocationUser $location): \Illuminate\Http\JsonResponse
    {
        $this->locationUsersService->deleteUserLocation($location);

        return response()->json([
            'message' => 'Location deleted successfully'
        ]);
    }
}
