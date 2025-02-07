<?php

namespace App\Http\Controllers;

use App\Models\BoardItem;
use App\Models\WorkSpace;
use Illuminate\Http\Request;

class TaskPriorityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('task-priority.index');
    }

    public function json()
    {
        $data = BoardItem::with('board', 'files', 'comments', 'board.workSpace', 'board.workSpace.client')
            ->get();

        $priorities = [
            'Sin Definir' => ['id' => 'sin-definir', 'title' => 'Sin Definir', 'item' => []],
            'Alta' => ['id' => 'alta', 'title' => 'Prioridad Alta', 'item' => []],
            'Media' => ['id' => 'media', 'title' => 'Prioridad Media', 'item' => []],
            'Baja' => ['id' => 'baja', 'title' => 'Prioridad Baja', 'item' => []]
        ];

        foreach ($data as $board) {
            $priorityKey = $board->priority ?? 'Sin Definir';

            if (!isset($priorities[$priorityKey])) {
                $priorityKey = 'Sin Definir';
            }

            $priorities[$priorityKey]['item'][] = [
                    'id'            => $board->id,
                    'title'         => $board->board->workSpace->client->firstname . ' ' . $board->board->workSpace->client->second_name . ' ' . $board->board->workSpace->client->lastname . ' ' . $board->board->workSpace->client->second_surname,
                    'title-secondary' => $board->title,
                    'start-date'    => $board->start_date,
                    'due-date'      => $board->due_date,
                    'description'   => $board->description,
                    'priority'      => $board->priority,
                    'badge-text'    => $board->badge_text,
                    'badge'         => $board->badge,
                    'facturable'    => $board->billable_task,
                    'created_at'    => $board->created_at,
            ];
        }

        return response()->json(array_values($priorities));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
