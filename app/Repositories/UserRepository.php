<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\Role;
use App\Models\User;
use App\Services\RoleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request as FacadesRequest;

class UserRepository implements UserRepositoryInterface
{
    public function all()
    {
        return User::where('is_admin', '!=', Role::DEFAULT_ADMIN_ROLE_ID)->get();
    }

    public function findById($user_id)
    {
        return User::where(['id' => $user_id])->firstOrFail();
    }

    public function findByRole($role_id)
    {
        return User::where(['role_id' => $role_id])->get();
    }

    public function findByParams($arrParams)
    {
        return User::where($arrParams)->first();
    }

    public function create($user)
    {
        return User::create($user);
    }

    public function update($id, $request)
    {
        $user = User::findOrFail($id);
        $user->organization = $request->organization;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->city = $request->city;
        $user->zip = $request->zip;
        $user->save();
        return $user;
    }

    public function createOrUpdate($id = null, $collection = [])
    {
        return User::updateOrCreate(['id' => $id], $collection);
    }

    public function delete($id)
    {
        User::findOrFail($id)->delete();
    }

    /**
     * @description search tenant user
     * @param $params
     * @return object
     */
    public function search($params): object
    {
        $query = User::query();
        $query->join('domains', 'domains.user_id', 'users.id');
        foreach ($params as $key => $value) {
            if ($value != '' && $key != '_token') {
                switch ($key) {
                    case 'role_id':
                        $query->where('role_id', $value);
                        break;
                    case 'domain':
                        $query->where('domains.domain', 'like', $value . '%');
                        break;
                    default:
                        $query->where($key, 'like', $value . '%');
                }
            }
        }
        return $query->paginate(env('PAGE_COUNT'));
    }
}
