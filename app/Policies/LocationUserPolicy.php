<?php

namespace App\Policies;

use App\Models\Location;
use App\Models\LocationUser;
use App\Models\User;
use App\Repositories\LocationUserRepository;
use Illuminate\Auth\Access\Response;

class LocationUserPolicy
{
    public function __construct(private LocationUserRepository $locationUserRepository) {}

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Location $location): Response
    {
        $locationUser = $this->locationUserRepository->findForCurrentUser($location->id);

        return $locationUser ? Response::allow() : Response::deny('This action is unauthorized.');
    }
}
