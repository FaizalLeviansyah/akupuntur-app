<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Patient;

class PatientSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 50; $i++) {
            Patient::create([
                'registration_number' => 'REG-' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'name' => 'Pasien Proyeksi ' . $i,
                'age' => rand(20, 70),
                'gender' => $i % 2 == 0 ? 'L' : 'P',
                'religion' => 'Islam',
                'job' => 'Swasta',
                'address' => 'Jl. Contoh No. ' . $i,
                'phone' => '0812345678' . $i,
                'bmi' => rand(18, 30),
            ]);
        }
    }
}
