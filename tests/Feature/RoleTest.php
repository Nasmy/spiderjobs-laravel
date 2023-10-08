<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use App\Services\RoleService;
use App\Services\UserService;
use Database\Seeders\PermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleTest extends TestCase
{
    use RefreshDatabase;

    private RoleService $roleService;
    private UserService $userService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->roleService = new RoleService(new RoleRepository());
        $this->userService = new UserService(new UserRepository());
        $this->seed(PermissionSeeder::class);
        $this->superAdmin = $this->createSuperAdmin();
    }

    /** @test */
    public function should_create_a_role_with_a_valid_data()
    {
        $roleForm = [
            'name' => 'Project Owner Here',
            'description' => 'A project owner role description',
            'permissions' => [1],
        ];
        $this->actingAs($this->superAdmin)
            ->post(route('role-store'), $roleForm)
            ->assertSessionHasNoErrors()
            ->assertSessionHas('role-creation-success')
            ->assertRedirect(route('role'));

        $createdRole = $this->roleService->listRole()[1];

        $this->assertNotNull($createdRole);
        $this->assertEquals($roleForm['name'], $createdRole->name);
        $this->assertEquals($roleForm['description'], $createdRole->description);
        $this->assertTrue($createdRole->active);
        $this->assertEquals('project-owner-here', $createdRole->ident);
    }

    /**
     * @dataProvider invalidRoleNames
     * @test
     */
    public function should_reject_names_with_special_chars_and_accepts_only_spaces($value)
    {
        $roleForm = [
            'name' => $value,
            'description' => 'A project owner role description',
            'permissions' => [1],
        ];
        $this->actingAs($this->superAdmin)
            ->post(route('role-store'), $roleForm)
        ->assertSessionHasErrors('name');
    }

    public function invalidRoleNames()
    {
        return [
            ['Â name with $pecial chars ^_^'],
            [''],
            ['    '],
            ['name \''],
        ];
    }
    private function createSuperAdmin()
    {
        $superAdminRole = Role::create([
            'name' => 'Admin',
            'ident' => 'admin',
            'description' => 'admin',
            'active' => true
        ]);

        return $this->userService->createUser([
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'email' => 'super.admin@example.com',
            'mobile' => '+123456789',
            'city' => 'City',
            'zip' => '123456',
            'address' => 'Some place, Earth',
            'role_id' => $superAdminRole->id,
            'is_admin' => true,
            'password' => 'secret',
            'username' => 'SuperAdmin',
        ]);
    }
}
