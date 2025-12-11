<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AssignUsersToDepartmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get departments
        $finDept = \App\Models\Department::where('code', 'FIN')->first();
        $itDept = \App\Models\Department::where('code', 'IT')->first();
        $opsDept = \App\Models\Department::where('code', 'OPS')->first();

        // Get users
        $auditeeSM = \App\Models\User::where('username', 'auditee_sm')->first();
        $auditeeEM = \App\Models\User::where('username', 'auditee_em')->first();

        // Assign Auditee SM to Finance as SM
        if ($finDept && $auditeeSM) {
            $auditeeSM->update([
                'department_id' => $finDept->id,
                'is_department_head' => true,
            ]);
            $finDept->update(['sm_user_id' => $auditeeSM->id]);
        }

        // Assign Auditee EM to Operations as SM
        if ($opsDept && $auditeeEM) {
            $auditeeEM->update([
                'department_id' => $opsDept->id,
                'is_department_head' => true,
            ]);
            $opsDept->update(['sm_user_id' => $auditeeEM->id]);
        }

        // Create additional dummy users for departments
        $this->createDummyUsers($finDept, $itDept, $opsDept);
    }

    private function createDummyUsers($finDept, $itDept, $opsDept)
    {
        $auditeeSMRole = \App\Models\Role::where('name', 'auditee_sm')->first();
        $auditeeEMRole = \App\Models\Role::where('name', 'auditee_em')->first();

        // Finance Department Users
        \App\Models\User::create([
            'name' => 'Budi Santoso',
            'username' => 'budi.santoso',
            'email' => 'budi.santoso@kig.co.id',
            'employee_id' => 'KIG101',
            'department' => 'Finance',
            'position' => 'Finance Staff',
            'role_id' => $auditeeEMRole->id,
            'department_id' => $finDept->id,
            'is_active' => true,
            'password' => \Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        \App\Models\User::create([
            'name' => 'Siti Nurhaliza',
            'username' => 'siti.nurhaliza',
            'email' => 'siti.nurhaliza@kig.co.id',
            'employee_id' => 'KIG102',
            'department' => 'Finance',
            'position' => 'Accounting Staff',
            'role_id' => $auditeeEMRole->id,
            'department_id' => $finDept->id,
            'is_active' => true,
            'password' => \Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        // IT Department Users
        \App\Models\User::create([
            'name' => 'Ahmad Fauzi',
            'username' => 'ahmad.fauzi',
            'email' => 'ahmad.fauzi@kig.co.id',
            'employee_id' => 'KIG201',
            'department' => 'IT',
            'position' => 'IT Manager',
            'role_id' => $auditeeSMRole->id,
            'department_id' => $itDept->id,
            'is_department_head' => true,
            'is_active' => true,
            'password' => \Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        // Set IT SM
        $itDept->update(['sm_user_id' => \App\Models\User::where('username', 'ahmad.fauzi')->first()->id]);

        \App\Models\User::create([
            'name' => 'Dewi Lestari',
            'username' => 'dewi.lestari',
            'email' => 'dewi.lestari@kig.co.id',
            'employee_id' => 'KIG202',
            'department' => 'IT',
            'position' => 'Developer',
            'role_id' => $auditeeEMRole->id,
            'department_id' => $itDept->id,
            'is_active' => true,
            'password' => \Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        // Operations Department Users
        \App\Models\User::create([
            'name' => 'Rudi Hartono',
            'username' => 'rudi.hartono',
            'email' => 'rudi.hartono@kig.co.id',
            'employee_id' => 'KIG301',
            'department' => 'Operations',
            'position' => 'Operations Staff',
            'role_id' => $auditeeEMRole->id,
            'department_id' => $opsDept->id,
            'is_active' => true,
            'password' => \Hash::make('password'),
            'email_verified_at' => now(),
        ]);
    }
}
