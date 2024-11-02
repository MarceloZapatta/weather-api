<?php

namespace App\Services;

use App\Exceptions\LocationUserAlreadyExistsException;
use App\Models\LocationUser;
use App\Repositories\LocationUserRepository;
use Illuminate\Http\Response;

/**
 * Class LocationUsersService
 * @package App\Services
 */
class LocationUsersService
{
    public function __construct(private LocationUserRepository $locationUserRepository, private LocationService $locationService) {}

    /**
     * Get user locations
     *
     * @return \Illuminate\Support\Collection
     */
    public function getUserLocations(): \Illuminate\Support\Collection
    {
        return $this->locationUserRepository->getForCurrentUser();
    }

    /**
     * Store user location
     *
     * @param int $locationId
     */
    public function storeUserLocation(int $locationId): void
    {
        $location = $this->locationUserRepository->findForCurrentUser($locationId);

        // if ($location) {
        //     throw new LocationUserAlreadyExistsException();
        // }

        $this->locationUserRepository->createForCurrentUser($locationId);

        $this->locationService->updateFiveDaysForecast($locationId);
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

        $this->locationUserRepository->delete($locationUser);
    }
}
