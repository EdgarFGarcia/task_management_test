<?php

namespace App\Http\Controllers\User\Service;

/**
 * service layer interface | contract
 */
use App\Http\Controllers\User\Service\Interface\IServiceUser;

/**
 * repository concrete class
 */
use App\Http\Controllers\User\Repository\RepositoryUser;


/**
 * laravel facade helper
 */
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;

class ServiceUser implements IServiceUser
{

    /**
     * class properties
     */
    protected $repo_user;

    /**
     * DIP
     * @App\Http\Controllers\User\Repository\RepositoryUser
     */
    function __construct(
        RepositoryUser $repo_user
    ){
        $this->repo_user = $repo_user;
    }

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
    ) : object | int{
        $data['password'] = Hash::make($data['password']);
        $data['email_verified_at'] = date('Y-m-d H:i:s');
        return $this->repo_user->register($data);
    }

    /**
     * login user
     * @params
     * array $data
     *
     * @return
     * object
     */
    public function loginUser(
        array $data
    ): object | int | bool{
        $is_auth = $this->isAuth($data);
        if($is_auth){
            return $this->generateToken($is_auth);
        }
        return false;
    }


    /**
     | ---------------------------------------------------
     | non interfaced behaviors
     | decorator pattern
     | ---------------------------------------------------
     */
    /**
     * auth attempt
     * @params
     * string email
     * string password
     *
     * @returns
     * int | bool
     */
    public function isAuth(
        array $data
    ) : int | bool | object{
        $is_auth = Auth::attempt($data);
        if($is_auth){
            return Auth::user();
        }
    }

    /**
     * generate token
     */
    public function generateToken(
        Model $user
    ){
        return $user->createToken($user->email);
    }
}
