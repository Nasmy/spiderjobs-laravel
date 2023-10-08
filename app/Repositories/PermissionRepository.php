<?php

namespace App\Repositories;

use App\Interfaces\PermissionRepositoryInterface;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;

class PermissionRepository implements PermissionRepositoryInterface
{
    public function all()
    {
        return Permission::all();
    }

    public function findByGroup($keyword)
    {
        return DB::table('permissions')->get()->groupBy($keyword);
    }

    public function findByIdent($ident)
    {
        return Permission::where('ident', $ident)->first();
    }
    public function findByName($name)
    {
    }
    public function findById($id)
    {
    }
    public function createOrUpdate($id = null, $collection = [])
    {
    }
    public function delete($id)
    {
    }
}
