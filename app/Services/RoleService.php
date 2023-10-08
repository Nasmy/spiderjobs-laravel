<?php
/**
 * @name RoleService
 *
 * @author Nasmy Ahamed
 * @copyright Beyond Technologies (PVT) ltd
 */

namespace App\Services;

use App\Interfaces\RoleRepositoryInterface;
use App\Models\Role;
use App\Traits\ApiResponse;
use App\Utils\ID;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;

/**
 * @description The class contain all business logics related with roles
 */
class RoleService
{
    use ApiResponse;

    // Response success messages
    const MESSAGE_SUCCESS_ROLE_CREATE = "Successfully created roles";
    const MESSAGE_FAILED_ROLE_CREATE = "Role creation failed";
    const MESSAGE_SUCCESS_ROLE_UPDATE = "Successfully Updated roles";
    const MESSAGE_FAILED_ROLE_UPDATE = "Role update failed";

    const PERMISSION_PARENT = 'roles';

    public $isUpdate = false;


    public $roleRepository;

    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    /**
     * @description retrive all roles
     * @return mixed
     */
    public function all()
    {
        return $this->roleRepository->all();
    }

    /**
     * @description retrive roles info by role id
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        return $this->roleRepository->findById($id);
    }

    /**
     * @description the method use for role update or create. If $isUpdate set true we assume as update
     * @param $data
     * @param null $id
     * @return Application|RedirectResponse|Redirector
     */
    public function createOrUpdate($data, $id = null) {
         $this->isUpdate = $id != null;
         $pdo = DB::connection()->getPdo();
         try {
             $pdo->beginTransaction();
             $roleData = [
                 'name' => $data['name'],
                 'ident' => ID::fromString($data['name']),
                 'description' => $data['description'],
                 'active' => Role::ROLE_ACTIVE,
                 'permissions' => $data['permissions']
             ];
             $roleData = $this->roleRepository->createOrUpdate($id, $roleData);
             $pdo->commit();
             ($this->isUpdate) ? session()->flash('role-creation-success', self::MESSAGE_SUCCESS_ROLE_UPDATE) : session()->flash('role-creation-success', self::MESSAGE_SUCCESS_ROLE_CREATE);
             // TODO need to handle common way to implement both api and web
             return redirect('role');
         } catch (\Exception $e) {
             $pdo->rollBack();
             // TODO need to handle common way to implement both api and web
             ($this->isUpdate) ? session()->flash('role-creation-fail', self::MESSAGE_FAILED_ROLE_UPDATE) : session()->flash('role-creation-fail', self::MESSAGE_FAILED_ROLE_CREATE);
             return back();
         }
    }

    /**
     * @description When deleting role the relevant Permissions also should delete
     * @param $id
     * @return JsonResponse
     */
    public function delete($id): JsonResponse
    {
        try {
            $role = $this->roleRepository->delete($id);
            return $this->sendResponse($role, 'Role successfully deleted ');
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), '401');
        }
    }
}
