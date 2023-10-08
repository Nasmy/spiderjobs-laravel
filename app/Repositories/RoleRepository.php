<?php

namespace App\Repositories;

use App\Interfaces\RoleRepositoryInterface;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class RoleRepository implements RoleRepositoryInterface
{
    public function all()
    {
        return Role::where('ident', '!=', Role::DEFAULT_ROLE)->get();
    }

    public function findByIndent($ident)
    {
        return Role::where('ident', $ident)->get();
    }

    public function findByName($name)
    {
        return Role::where('name', $name)->get();
    }

    public function findById($id)
    {
        return Role::findOrFail($id);
    }

    public function createOrUpdate($id = null, $data = []): Role
    {
        $role = Role::updateOrCreate(['id' => $id], $data);
        $role->permissions()->sync($data['permissions']);
        return $role;
    }

    public function delete($id)
    {
        $role = Role::findOrFail($id);
        return $role->delete();
    }
}
