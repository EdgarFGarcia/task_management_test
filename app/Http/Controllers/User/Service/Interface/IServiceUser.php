<?php

namespace App\Http\Controllers\User\Service\Interface;

interface IServiceUser
{
    /**
     * register a user
     * @params
     * array $data
     *
     * @return
     * object | int
     */
    public function register(
        array $data
    ) : object | int;

    /**
     * login user
     * @params
     * array $data
     *
     * @return
     * object | int | bool
     */
    public function loginUser(
        array $data
    ): object | int | bool;
}
