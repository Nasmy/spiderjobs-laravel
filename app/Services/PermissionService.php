<?php
/**
 * @name PermissionService
 *
 * @author Nasmy Ahamed
 * @copyright Beyond Technologies (PVT) ltd
 */
namespace App\Services;

use App\Interfaces\PermissionRepositoryInterface;

/**
 * @description The class contain all business logics related with Permissions
 */
class PermissionService
{
    const PERMISSION_VIEW = "show";
    const PERMISSION_CREATE = "create";
    const PERMISSION_EDIT = "update";
    const PERMISSION_DELETE = "destroy";
    const PERMISSION_APPROVE = "approve";
    const PERMISSION_GROUP_KEY_PARENT = 'parent';
    const PERMISSION_PARENT = 'permissions';

    public $permissionRepository;

    public function __construct(PermissionRepositoryInterface $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }


    /**
     * @description list all permissions
     */
    public function all() {
        $this->permissionRepository->all();
    }

    /**
     * @description @attr is field of table which we are going to group
     * @param $attr
     */
    public function findByGroup($attr) {
        return $this->permissionRepository->findByGroup($attr);
    }

    public static function concatPermissions($parent, $child) {
        return ($parent != null && $child != null) ?$parent.".".$child : null;
    }

    /**
     * @description this is use for set permissions for permission seeder
     * @return array[]
     */
    public static function getPermissions(): array
    {
        return [
            [
                "name" => "User Management",
                "parent" => RoleService::PERMISSION_PARENT,
                "child" => [self::PERMISSION_VIEW, self::PERMISSION_CREATE,self::PERMISSION_EDIT, self::PERMISSION_DELETE, self::PERMISSION_APPROVE],
                "description" => "Manage Roles",
                "active" => 1
            ],

            [
                "name" => "User Management",
                "parent" => self::PERMISSION_PARENT,
                "child" => [self::PERMISSION_VIEW],
                "description" => "Manage Permissions",
                "active" => 1
            ],

            [
                "name" => "User Management",
                "parent" => UserService::PERMISSION_PARENT,
                "child" => [self::PERMISSION_VIEW, self::PERMISSION_CREATE,self::PERMISSION_EDIT, self::PERMISSION_DELETE],
                "description" => "Manage Users",
                "active" => 1
            ],

            [
                "name" => "Job Application Management",
                "parent" => JobApplicationService::PERMISSION_PARENT,
                "child" => [self::PERMISSION_VIEW, self::PERMISSION_CREATE,self::PERMISSION_EDIT, self::PERMISSION_DELETE],
                "description" => "Manage Applications",
                "active" => 1
            ],

            [
                "name" => "Job Management",
                "parent" => JobService::PERMISSION_PARENT,
                "child" => [self::PERMISSION_VIEW, self::PERMISSION_CREATE,self::PERMISSION_EDIT, self::PERMISSION_DELETE,self::PERMISSION_APPROVE],
                "description" => "Manage Jobs",
                "active" => 1
            ],

            [
                "name" => "Job Management",
                "parent" => JobCategoryService::PERMISSION_PARENT,
                "child" => [self::PERMISSION_VIEW, self::PERMISSION_CREATE,self::PERMISSION_EDIT, self::PERMISSION_DELETE,self::PERMISSION_APPROVE],
                "description" => "Manage Category",
                "active" => 1
            ],

            [
                "name" => "Job Management",
                "parent" => ExperienceService::PERMISSION_PARENT,
                "child" => [self::PERMISSION_VIEW, self::PERMISSION_CREATE,self::PERMISSION_EDIT, self::PERMISSION_DELETE,self::PERMISSION_APPROVE],
                "description" => "Manage Experience",
                "active" => 1
            ],

            [
                "name" => "Job Management",
                "parent" => EmploymentTypeService::PERMISSION_PARENT,
                "child" => [self::PERMISSION_VIEW, self::PERMISSION_CREATE,self::PERMISSION_EDIT, self::PERMISSION_DELETE],
                "description" => "Manage Employment",
                "active" => 1
            ],
        ];
    }
}
