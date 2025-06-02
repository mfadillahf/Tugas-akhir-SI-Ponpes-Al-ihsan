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
            'lihat infaq',
            'tambah infaq',
            'lihat galeri',
            'kelola galeri',
            'lihat nilai',
            'kelola nilai',
            'lihat hapalan',
            'kelola hapalan',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        //Assign Permission
        $admin->syncPermissions(Permission::all());

        $guru->syncPermissions([
            'lihat nilai',
            'kelola nilai',
            'lihat hapalan',
            'kelola hapalan',
        ]);

        $donatur->syncPermissions([
            'lihat infaq',
            'tambah infaq',
        ]);

        $santri->syncPermissions([
            'lihat nilai',
            'lihat berita',
            'lihat galeri',
            'lihat hapalan',
        ]);
    }
}
