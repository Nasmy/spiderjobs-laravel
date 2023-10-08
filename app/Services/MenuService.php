<?php

namespace App\Services;

class MenuService
{
    public static $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * @description set menu list for retrieve dynamically
     * @return array
     */
    public static function getMenuList()
    {
        return [
            [
                "url" => "dashboard",
                "name" => "Dashboards",
                "icon" => "menu-icon tf-icons bx bx-home-circle",
                "slug" => "dashboard",
            ],

            [
                "url" => "manage-applications",
                "name" => "Manage Application",
                "icon" => "menu-icon tf-icons bx bx-food-menu",
                "slug" => "manage-applications",
            ],

            [
                "name" => "Manage Jobs",
                "icon" => "menu-icon tf-icons bx bx-user",
                "slug" => "job",
                "submenu" => [
                    [
                        "url" => "job",
                        "name" => "Jobs",
                        "slug" => "job",
                        "parent" => JobService::PERMISSION_PARENT,
                        "child" => PermissionService::PERMISSION_VIEW
                    ],
                    [
                        "url" => "job-category",
                        "name" => "Category",
                        "slug" => "job-category",
                        "parent" => JobCategoryService::PERMISSION_PARENT,
                        "child" => PermissionService::PERMISSION_VIEW
                    ]
                ]
            ],
            [
                "name" => "System Settings",
                "icon" => "menu-icon tf-icons bx bx-cog",
                "slug" => "#",
                "submenu" => [
                    [
                        "url" => "role",
                        "name" => "Role",
                        "slug" => "role",
                        "parent" => RoleService::PERMISSION_PARENT,
                        "child" => PermissionService::PERMISSION_VIEW

                    ],
                    [
                        "url" => "user",
                        "name" => "Manage System Users",
                        "slug" => "user",
                        "parent" => RoleService::PERMISSION_PARENT,
                        "child" => PermissionService::PERMISSION_VIEW
                    ],
                    [
                        "url" => "configuration-update",
                        "name" => "Configuration",
                        "slug" => "configuration-update",
                        "parent" => ConfigurationService::PERMISSION_PARENT,
                        "child" => PermissionService::PERMISSION_VIEW
                    ]
                ]
            ],
        ];
    }

}
