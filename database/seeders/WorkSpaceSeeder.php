<?php

namespace Database\Seeders;

use App\Models\Board;
use App\Models\WorkSpace;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class WorkSpaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $workspace = WorkSpace::create([
            'user_id' => 2,
            'title' => 'Gestiones Administrador',
            'description' => 'panel de gestion del administrador',
            'status' => 'Activo'
        ]);

        Board::create(['work_space_id' => $workspace->id,'title' => 'Gestiones o Tareas', 'title_slug' => 'gestiones-o-tareas']);
        Board::create(['work_space_id' => $workspace->id,'title' => 'Pendientes', 'title_slug' => 'pendientes']);
        Board::create(['work_space_id' => $workspace->id,'title' => 'En Proceso', 'title_slug' => 'en-proceso']);
        Board::create(['work_space_id' => $workspace->id,'title' => 'En Revision', 'title_slug' => 'en-revision']);
        Board::create(['work_space_id' => $workspace->id,'title' => 'Finalizadas', 'title_slug' => 'finalizadas']);
    }
}
