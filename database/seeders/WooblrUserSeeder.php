<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WooblrUserSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        $permissions = [
            'user.create',
            'user.viewAny',
            'user.edit',
            'user.delete',
            'role.create',
            'role.viewAny',
            'role.edit',
            'role.delete',
            'setting.viewAny',
            'setting.edit'
        ];

        foreach ($permissions as $permission) {
            \Spatie\Permission\Models\Permission::firstOrCreate(['name' => $permission]);
        }
        // Buat Role
        $roleOwner = \Spatie\Permission\Models\Role::create(['name' => 'Owner']);
        $user = User::query()->create([
            'name'      => 'Wooblr Owner',
            'email'     => 'owner@wooblr.com',
            'password'  => 'password'
        ]);
        // Assign Role
        $user->assignRole($roleOwner);
    }
}
