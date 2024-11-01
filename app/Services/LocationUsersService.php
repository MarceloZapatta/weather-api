<?php

namespace App\Services;

use App\Exceptions\LocationUserAlreadyExistsException;
use App\Models\LocationUser;
use Illuminate\Http\Response;

/**
 * Class LocationUsersService
 * @package App\Services
 */
class LocationUsersService
{
    /**
     * Get user locations
     *
     * @return \Illuminate\Support\Collection
     */
    public function getUserLocations(): \Illuminate\Support\Collection
    {
        return auth()->user()->locations;
    }

    /**
     * Store user location
     *
     * @param int $locationId
     */
    public function storeUserLocation(int $locationId): void
    {
        $user = auth()->user();

        $locationUser = LocationUser::where('user_id', $user->id)->where('location_id', $locationId)->first();

        if ($locationUser) {
            throw new LocationUserAlreadyExistsException();
        }

        $user->locations()->attach($locationId);
    }

    /**
     * Delete user location
     *
     * @param LocationUser $locationUser
     */
    public function deleteUserLocation(LocationUser $locationUser): void
    {
        if ($locationUser->user_id !== auth()->id()) {
            throw new \Illuminate\Auth\Access\AuthorizationException('This action is unauthorized.');
        }

        $locationUser->delete();
    }
}
