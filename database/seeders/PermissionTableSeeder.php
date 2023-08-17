<?php

namespace Database\Seeders;

//use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'document-list',
            'document-create',
            'document-edit',
            'document-delete',
            'permission-list',
            'permission-create',
            'permission-edit',
            'permission-delete',
            'project-list',
            'project-create',
            'project-edit',
            'project-delete'
         ];

         foreach ($permissions as $permission) {
              Permission::create(['name' => $permission]);
         }

    }
}
