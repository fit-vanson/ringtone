<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        $role = Role::create(['name' => 'admin']);
        $role = Role::create(['name' => 'user']);
        $user = User::create([
            'name' => 'admin',
            'password' => bcrypt('123456789.'),
            'email' => 'admin@admin.com',
        ]);
        $user->assignRole('admin') ;
    }
}
