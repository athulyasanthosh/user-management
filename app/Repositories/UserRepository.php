<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Request;
use Symfony\Component\Translation\Exception\NotFoundResourceException;
use Mail;

class UserRepository extends BaseRepository

{
    private $userDetail;
    /**
     * AdminRepository constructor.
     *
     * @author athulya <athulyasanthosh95@gmail.com>
     *
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * Create model data
     *
     * @param [array | Request] $data - data to store
     * @return User
     */
    public function createNew($data)
    {
        if ($data instanceof Request) {
            $data = $data->all();
        }

        $userData = Arr::only($data, $this->model->getFillable());  
        $password = Str::random(12);
        $userData['password'] = Hash::make($password );       

        // Log user data
        Log::info('------------------------------------------------------------');
        Log::info($userData['name']);
        Log::info(['password' => $password ]);
        Log::info('------------------------------------------------------------');
        
        $user = $this->model->create($userData);

        return $user;
    }

    public function updateUserInfo($id, $data)
    {
        if ($id instanceof $this->model) {
            $user = $id;
        } else {
            $user = $this->model->find($id);
            if (empty($user)) {
                throw new NotFoundResourceException('User not found', 404);
            }
        }
        
        $userData = Arr::only($data, $this->model->getFillable());

        $users = $user->update($userData);
        return $users;
    }
}