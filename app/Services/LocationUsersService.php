<?php

namespace App\Services;

use App\Exceptions\LocationUserAlreadyExistsException;
use App\Models\Location;
use App\Models\LocationUser;
use App\Repositories\LocationUserRepository;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

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
    public function storeUserLocation(string $country, string $city): Location
    {
        $location = $this->locationService->findLocationByCountryName($country, $city);

        if (!$location) {
            $location = $this->locationService->createLocation($country, $city);
        }

        $locationUser = $this->locationUserRepository->findForCurrentUser($location->id);

        if ($locationUser) {
            throw new LocationUserAlreadyExistsException();
        }

        $this->locationUserRepository->createForCurrentUser($location->id);

        return $location->refresh();
    }

    /**
     * Delete user location
     *
     * @param Location $locationUser
     */
    public function deleteUserLocation(Location $location): void
    {
        Gate::authorize('delete-user-location', $location);

        $locationUser = $this->locationUserRepository->findForCurrentUser($location->id);

        if (!$locationUser) {
            throw new \Illuminate\Auth\Access\AuthorizationException('This action is unauthorized.');
        }

        $this->locationUserRepository->delete($locationUser);
    }
}
