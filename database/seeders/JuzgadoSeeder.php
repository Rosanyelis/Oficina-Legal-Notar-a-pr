<?php

namespace Database\Seeders;

use App\Models\Juzgado;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JuzgadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Juzgado::create(['name' => 'JUZGADO ORAL LABORAL PRIMERO']);
        Juzgado::create(['name' => 'JUZGADO ORAL LABORAL SEGUNDO']);
        Juzgado::create(['name' => 'JUZGADO ORAL LABORAL TERCERO']);
    }
}
