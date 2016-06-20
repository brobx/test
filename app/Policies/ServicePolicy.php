<?php

namespace App\Policies;

use App\Corporate;
use App\Service;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ServicePolicy
{
    use HandlesAuthorization;

    /**
     * @param Service $service
     * @param Corporate $corporate
     * @return mixed
     */
    private function serviceBelongsToCorporate(Service $service, Corporate $corporate)
    {
        return $corporate->type->services()
                               ->where('id', $service->id)
                               ->exists();
    }

    /**
     * @param User $user
     * @param Service $service
     * @return mixed
     */
    public function index(User $user, Service $service)
    {
        return $this->serviceBelongsToCorporate($service, $user->corporate);
    }

    /**
     * @param User $user
     * @param Service $service
     * @return mixed
     */
    public function store(User $user, Service $service)
    {
        return $this->serviceBelongsToCorporate($service, $user->corporate);
    }

    /**
     * @param User $user
     * @param Service $service
     * @return mixed
     */
    public function update(User $user, Service $service)
    {
        return $this->serviceBelongsToCorporate($service, $user->corporate);
    }

    /**
     * @param User $user
     * @param Service $service
     * @return mixed
     */
    public function destroy(User $user, Service $service)
    {
        return $this->serviceBelongsToCorporate($service, $user->corporate);
    }
}
