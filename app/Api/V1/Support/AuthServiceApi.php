<?php

namespace App\Api\V1\Support;

use App\Admin\Repositories\Driver\DriverRepositoryInterface;
use App\Admin\Repositories\Nany\NanyRepositoryInterface;
use App\Admin\Repositories\Parent\ParentRepositoryInterface;
use Exception;
use Illuminate\Contracts\Auth\Authenticatable;


trait AuthServiceApi
{
    private static string $GUARD_API = 'api';


    public function getCurrentUserId()
    {

        return auth(self::$GUARD_API)->user()->id;
    }

    public function getCurrentUser(): ?Authenticatable
    {
        return auth(self::$GUARD_API)->user();
    }

    /**
     * Get a user-related entity by field and value.
     *
     * @throws Exception
     */
    private function getEntityByUserId($repositoryInterface)
    {
        $repository = app($repositoryInterface);
        $userId = $this->getCurrentUserId();
        return $repository->findByField('user_id', $userId);
    }

    /**
     * @throws Exception
     */
    public function getCurrentDriver()
    {
        return $this->getEntityByUserId(DriverRepositoryInterface::class);
    }

    /**
     * @throws Exception
     */
    public function getCurrentDriverId()
    {
        $driver = $this->getCurrentDriver();
        return $driver ? $driver->id : null;
    }

    /**
     * @throws Exception
     */
    public function getCurrentParent()
    {
        return $this->getEntityByUserId(ParentRepositoryInterface::class);

    }

    /**
     * @throws Exception
     */
    public function getCurrentParentId()
    {

        $parent = $this->getCurrentParent();
        return $parent ? $parent->id : null;
    }

    /**
     * @throws Exception
     */
    public function getCurrentNany()
    {
        return $this->getEntityByUserId(NanyRepositoryInterface::class);
    }

    /**
     * @throws Exception
     */
    public function getCurrentNanyId()
    {

        $nany = $this->getCurrentNany();
        return $nany ? $nany->id : null;
    }
}
