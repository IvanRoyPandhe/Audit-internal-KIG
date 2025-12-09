<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            [
                'name' => 'admin',
                'display_name' => 'Administrator',
                'description' => 'Akses penuh ke seluruh sistem'
            ],
            [
                'name' => 'auditor',
                'display_name' => 'Auditor',
                'description' => 'Dapat membuat dan mengelola audit'
            ],
            [
                'name' => 'auditee_sm',
                'display_name' => 'Auditee SM',
                'description' => 'Auditee Senior Management'
            ],
            [
                'name' => 'auditee_em',
                'display_name' => 'Auditee EM',
                'description' => 'Auditee Executive Management'
            ],
            [
                'name' => 'pimpinan',
                'display_name' => 'Pimpinan',
                'description' => 'Pimpinan perusahaan'
            ],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
