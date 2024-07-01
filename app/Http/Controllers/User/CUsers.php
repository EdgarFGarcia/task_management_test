<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * service concrete class
 */
use App\Http\Controllers\User\Service\ServiceUser;

/**
 * Validation
 */
use App\Http\Controllers\User\Validation\ValidateRegister;
use App\Http\Controllers\User\Validation\ValidateLogin;

class CUsers extends Controller
{
    /**
     * class properties
     */
    protected $service_user;

    /**
     * DIP
     * @App\Http\Controllers\User\Service\ServiceUser
     */
    function __construct(
        ServiceUser $service_user
    ){
        $this->service_user = $service_user;
    }


    /**
     * register a user
     * @params
     * Request $request
     *
     * @validation inject
     * ValidateRegister
     *
     * @return
     * object | array
     */
    public function register(
        ValidateRegister $request
    ) : object | array{
        try{
            $register_user = $this->service_user->register($request->validated());
            return response()->json([
                'response'  => true,
                'data'      => $register_user
            ], 200);
        }catch(\Exception $e){
            return $this->error($e, 500);
        }
    }

    /**
     * login user
     * @params
     * Request $request
     *
     * validation inject
     * @App\Http\Controllers\User\Validation\ValidateLogin
     *
     * @return
     * object
     */
    public function login(
        ValidateLogin $request
    ){
        try{
            $data = $this->service_user->loginUser($request->validated());
            return response()->json([
                'response'  => true,
                'data'      => $data
            ], 200);
        }catch(\Exception $e){
            return $this->error($e, 500);
        }
    }
}
