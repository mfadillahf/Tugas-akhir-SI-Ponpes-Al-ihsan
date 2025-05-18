<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Role
        $admin   = Role::firstOrCreate(['name' => 'admin']);
        $guru    = Role::firstOrCreate(['name' => 'guru']);
        $donatur = Role::firstOrCreate(['name' => 'donatur']);
        $santri  = Role::firstOrCreate(['name' => 'santri']);

        // Permissions 
        $permissions = [
            'lihat agenda',
            'kelola agenda',
            'lihat berita',
            'kelola berita',
            'lihat nilai',
            'kelola nilai',
            'lihat infaq',
            'kelola infaq',
            'lihat galeri',
            'kelola galeri',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        //Assign Permission
        $admin->syncPermissions(Permission::all());

        $guru->syncPermissions([
            'lihat nilai',
            'kelola nilai',
        ]);

        $donatur->syncPermissions([
            'lihat infaq',
        ]);

        $santri->syncPermissions([
            'lihat nilai',
            'lihat berita',
            'lihat galeri',
        ]);
    }
}
