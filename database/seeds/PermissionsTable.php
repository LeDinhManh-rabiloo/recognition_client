<?php

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Str;
use Spatie\Permission\PermissionRegistrar;

class PermissionsTable extends Seeder
{
    /**
     * @var \Illuminate\Support\Collection
     */
    protected $permissions;

    /**
     * RolesAndPermissionsSeeder constructor.
     */
    public function __construct()
    {
        $this->permissions = collect();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected function process()
    {
        // Clean cache
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $permissions = [
            'web' => [
                'role_add',
                'role_update',
                'role_delete',
                'user_add',
                'user_update',
                'user_delete',
                'teacher_create',
                'teacher_delete',
                'teacher_update',
                'student_create',
                'student_delete',
                'student_update',
                'report',
                'check',
            ],
        ];

        $roles = [
            'web' => [
                'Administrators' => ['*'],
                'Teachers' => [
                    'user_*',
                    'student_*',
                    'report',
                    'check'
                ],
            ],
            'front' => [],
        ];

        $this->createPermissionsAndRoles($permissions, $roles);
    }

    /**
     * Get permissions match with guard name and permission names
     *
     * @param array $perms
     * @param string $guard
     * @return \Illuminate\Support\Collection
     */
    protected function getPermissions(array $perms, string $guard)
    {
        return $this->permissions
            ->where('guard_name', $guard)
            ->filter(function (Permission $perm) use ($perms) {
                return Str::is($perms, $perm->name);
            });
    }

    /**
     * Create permissions ans roles
     *
     * @param array $permissions
     * @param array $roles
     */
    protected function createPermissionsAndRoles(array $permissions, array $roles)
    {
        // Reset cached roles and permissions
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        foreach ($permissions as $guard => $perms) {
            foreach ($perms as $perm) {
                // Create permissions
                $this->permissions->push(Permission::create(['name' => $perm, 'guard_name' => $guard]));
            }
        }

        foreach ($roles as $guard => $guardRoles) {
            foreach ($guardRoles as $role => $perms) {
                // Create role
                $role = Role::create(['name' => $role, 'guard_name' => $guard]);

                // Add permissions to role
                $role->givePermissionTo($this->getPermissions($perms, $guard));
            }
        }
    }
}
