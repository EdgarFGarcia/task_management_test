<?php

namespace App\Http\Controllers\User\Repository\Interface;

interface IRepositoryUser
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
    ) : object | int;
}
