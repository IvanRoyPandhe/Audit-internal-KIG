<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            [
                'code' => 'FIN',
                'name' => 'Finance',
                'description' => 'Departemen keuangan yang mengelola semua aspek finansial perusahaan',
                'is_active' => true,
            ],
            [
                'code' => 'IT',
                'name' => 'Information Technology',
                'description' => 'Departemen teknologi informasi yang mengelola infrastruktur IT dan sistem',
                'is_active' => true,
            ],
            [
                'code' => 'HR',
                'name' => 'Human Resources',
                'description' => 'Departemen sumber daya manusia yang mengelola karyawan dan rekrutmen',
                'is_active' => true,
            ],
            [
                'code' => 'OPS',
                'name' => 'Operations',
                'description' => 'Departemen operasional yang mengelola kegiatan operasional harian',
                'is_active' => true,
            ],
            [
                'code' => 'MKT',
                'name' => 'Marketing',
                'description' => 'Departemen pemasaran yang mengelola strategi pemasaran dan branding',
                'is_active' => true,
            ],
            [
                'code' => 'PROC',
                'name' => 'Procurement',
                'description' => 'Departemen pengadaan yang mengelola pembelian dan vendor',
                'is_active' => true,
            ],
            [
                'code' => 'QA',
                'name' => 'Quality Assurance',
                'description' => 'Departemen quality assurance yang memastikan kualitas produk dan layanan',
                'is_active' => true,
            ],
            [
                'code' => 'LOG',
                'name' => 'Logistics',
                'description' => 'Departemen logistik yang mengelola distribusi dan pergudangan',
                'is_active' => false,
            ],
        ];

        foreach ($departments as $dept) {
            \App\Models\Department::create($dept);
        }
    }
}
