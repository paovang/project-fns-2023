<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->roleSeeder();
    }

    public function roleSeeder()
    {
        $roleSuperAdmin = Role::create([
            'name' => 'super-admin', 'display_name' => 'Super Admin'
        ]);

        $roleAdmin  = Role::create([
            'name' => 'admin', 'display_name' => 'Admin'
        ]);


        /** Create Permission */
        $readStore = Permission::create(['name' => 'read-store', 'display_name' => 'Read Store']);
        $createStore = Permission::create(['name' => 'create-store', 'display_name' => 'Add Store']);
        $updateStore = Permission::create(['name' => 'update-store', 'display_name' => 'Update Store']);
        $deleteStore = Permission::create(['name' => 'delete-store', 'display_name' => 'Delete Store']);


        /** Create User */
        $createUserSuperAdmin = User::create([
            'name' => 'admin',
            'email' => 'super@gmail.com',
            'password' => Hash::make('super@admin'),
        ]);
        $createUserSuperAdmin->attachRoles([$roleSuperAdmin]);
        $createUserSuperAdmin->permissions()->attach([$readStore->id, $createStore->id, $updateStore->id, $deleteStore->id]);

        $createUserAdmin = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin@2023'),
        ]);
        $createUserAdmin->attachRoles([$roleAdmin]);
        $createUserAdmin->permissions()->attach([$readStore->id]);
    }
}
