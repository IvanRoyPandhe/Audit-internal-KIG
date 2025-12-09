<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::where('name', 'admin')->first();
        $auditorRole = Role::where('name', 'auditor')->first();
        $auditeeSMRole = Role::where('name', 'auditee_sm')->first();
        $auditeeEMRole = Role::where('name', 'auditee_em')->first();
        $pimpinanRole = Role::where('name', 'pimpinan')->first();

        User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@kig.co.id',
            'employee_id' => 'KIG001',
            'department' => 'IT',
            'position' => 'System Administrator',
            'role_id' => $adminRole->id,
            'is_active' => true,
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Auditor Senior',
            'username' => 'auditor',
            'email' => 'auditor@kig.co.id',
            'employee_id' => 'KIG002',
            'department' => 'Internal Audit',
            'position' => 'Senior Auditor',
            'role_id' => $auditorRole->id,
            'is_active' => true,
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Auditee SM',
            'username' => 'auditee_sm',
            'email' => 'auditee.sm@kig.co.id',
            'employee_id' => 'KIG003',
            'department' => 'Finance',
            'position' => 'Senior Manager',
            'role_id' => $auditeeSMRole->id,
            'is_active' => true,
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Auditee EM',
            'username' => 'auditee_em',
            'email' => 'auditee.em@kig.co.id',
            'employee_id' => 'KIG004',
            'department' => 'Operations',
            'position' => 'Executive Manager',
            'role_id' => $auditeeEMRole->id,
            'is_active' => true,
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Pimpinan',
            'username' => 'pimpinan',
            'email' => 'pimpinan@kig.co.id',
            'employee_id' => 'KIG005',
            'department' => 'Management',
            'position' => 'Direktur',
            'role_id' => $pimpinanRole->id,
            'is_active' => true,
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
    }
}
