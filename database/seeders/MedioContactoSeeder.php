<?php

namespace Database\Seeders;

use App\Models\MedioContacto;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MedioContactoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MedioContacto::create(['name' => 'OFICINA']);
        MedioContacto::create(['name' => 'RECOMENDACIÓN']);
        MedioContacto::create(['name' => 'REDES SOCIALES']);
        MedioContacto::create(['name' => 'PUBLICIDAD']);
        MedioContacto::create(['name' => 'OTRO']);
    }
}
