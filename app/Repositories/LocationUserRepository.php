<?php

namespace App\Repositories;

use App\Models\Location;
use App\Models\LocationUser;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class LocationUserRepository
 * @package App\Repositories
 */
class LocationUserRepository
{
    /**
     * @return Collection
     */
    public function getForCurrentUser(): Collection
    {
        $user = auth()->user();
        return $user->locations;
    }

    /**
     * @param int $locationId
     * @return LocationUser|null
     */
    public function findForCurrentUser(int $locationId): ?Location
    {
        $user = auth()->user();
        return $user->locations()->find($locationId);
    }

    /**
     * @param int $locationId
     * @return LocationUser
     */
    public function createForCurrentUser(int $locationId): void
    {
        $user = auth()->user();
        $user->locations()->attach($locationId);
    }

    /**
     * @param LocationUser $locationUser
     * @return bool
     */
    public function delete(LocationUser $locationUser): bool
    {
        return $locationUser->delete();
    }
}
