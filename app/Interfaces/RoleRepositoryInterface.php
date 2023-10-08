<?php

namespace App\Interfaces;

interface RoleRepositoryInterface
{
    public function all();
    public function findByIndent($ident);
    public function findByName($name);
    public function findById($id);
    public function createOrUpdate($id, $data);
    public function delete($id);
}
