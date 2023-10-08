<?php

namespace App\Interfaces;

interface UserRepositoryInterface
{
    public function all();
    public function findById($user_id);
    public function findByRole($role_id);
    public function findByParams($arrParams);
    public function create($user);
    public function createOrUpdate($id = null, $collection = []);
    public function delete($id);
    public function update($id,$request);
    public function search($params);
}
