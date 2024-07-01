<?php

namespace App\Http\Controllers\User\Repository;

/**
 * repository interface | contract
 */
use App\Http\Controllers\User\Repository\Interface\IRepositoryUser;

/**
 * model
 */
use App\Models\User;

class RepositoryUser implements IRepositoryUser
{
    /**
     * register a user
     * @params
     * array $data
     *
     * @return
     * object | int;
     */
    public function register(
        array $data
    ) : object | int{
        return User::create($data);
    }
}
