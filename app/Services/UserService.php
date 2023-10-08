<?php

namespace App\Services;

use App\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public $userRepository;

    const PERMISSION_PARENT = 'users';

    public function __construct(UserRepositoryInterface $userRepository)
    {
        return $this->userRepository = $userRepository;
    }

    public function all() {
        return $this->userRepository->all();
    }

    public function findById($id) {
        return $this->userRepository->findById($id);
    }

    public function delete($id) {
        return $this->userRepository->delete($id, true);
    }

    public function create($data) {

        $data['password'] = self::hashPassword($data['password']);

        $user = $this->userRepository->createOrUpdate(null, $data);

        if(isset($data['departments'])) {
            $user->departments()->attach($data['departments']);
        }

        return $user;
    }

    public function update($id, $data) {
        $data['password'] = self::hashPassword($data['password']);

        $user = $this->userRepository->createOrUpdate($id, $data);

        if(isset($data['departments'])) {
            $user->departments()->detach();
            $user->departments()->attach($data['departments']);
        }

        return $user;
    }

    /**
     * @description encrypt the password
     * @param $password
     * @return string
     */
    public static function hashPassword($password): string
    {
        return Hash::make($password);
    }

}
