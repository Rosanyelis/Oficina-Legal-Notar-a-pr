<?php

namespace App\Http\Controllers;

use Google\Client;
use App\Models\Board;
use App\Models\BoardItem;
use App\Models\WorkSpace;
use Illuminate\Support\Str;
use Google\Service\Calendar;
use Illuminate\Http\Request;
use App\Models\BoardItemFile;
use App\Models\Client as Clientes;
use Google\Service\Calendar\Event;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreWorkSpaceRequest;
use App\Http\Requests\UpdateWorkSpaceRequest;

class WorkSpaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = WorkSpace::orderBy('id', 'asc')->get();
        return view('kamban.index', compact('data'));
    }

    public function kambanJson($id)
    {
        $data = WorkSpace::with('boards', 'user', 'client', 'boards.items')->find($id);

        $boards = [];

        foreach ($data->boards as $board) {
            // Crear la estructura del board
            $boardData = [
                'id' => $board->title_slug,
                'title' => $board->title,
                'item' => []
            ];

            // Agregar los ítems relacionados
            foreach ($board->items as $item) {
                $boardData['item'][] = [
                    'id'            => $item->id,
                    'title'         => $item->title,
                    'start-date'    => $item->start_date,
                    'due-date'      => $item->due_date,
                    'description'   => $item->description,
                    'priority'      => $item->priority,
                    'badge-text'    => $item->badge_text,
                    'badge'         => $item->badge,
                    'created_at'    => $item->created_at,
                    'attachments'   => $item->files->count(),
                    'comments'      => $item->comments->count()
                ];
            }

            $boards[] = $boardData;
        }
        return response()->json($boards);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Clientes::all();
        return view('kamban.create', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWorkSpaceRequest $request)
    {
        $workspace = WorkSpace::create([
            'client_id' => $request->client_id,
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'description' => $request->description,
        ]);

        Board::create(['work_space_id' => $workspace->id,'title' => 'Gestiones o Tareas', 'title_slug' => 'gestiones-o-tareas']);
        Board::create(['work_space_id' => $workspace->id,'title' => 'Pendientes', 'title_slug' => 'pendientes']);
        Board::create(['work_space_id' => $workspace->id,'title' => 'En Proceso', 'title_slug' => 'en-proceso']);
        Board::create(['work_space_id' => $workspace->id,'title' => 'En Revision', 'title_slug' => 'en-revision']);
        Board::create(['work_space_id' => $workspace->id,'title' => 'Finalizadas', 'title_slug' => 'finalizadas']);

        return redirect()->route('gestiones.index')->with('success', 'Espacio de Trabajo creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show($workSpace)
    {
        $data = WorkSpace::with('boards', 'user', 'client')->find($workSpace);
        return view('kamban.show', compact('data'));
    }

    public function showclient($client_id)
    {
        $data = WorkSpace::with('boards', 'user', 'client')->where('client_id', $client_id)->first();
        if (!$data) {
            abort(404);
        }
        return view('kamban.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($workSpace)
    {
        $clients = Clientes::all();
        $data = WorkSpace::find($workSpace);
        return view('kamban.edit', compact('clients', 'data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWorkSpaceRequest $request, $workSpace)
    {
        $workspace = WorkSpace::find($workSpace);
        $workspace->update($request->all());
        return redirect()->route('gestiones.index')->with('success', 'Espacio de Trabajo actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($workSpace)
    {
        $workspace = WorkSpace::find($workSpace);
        $workspace->boards()->delete();
        $workspace->delete();
        return redirect()->route('gestiones.index')->with('success', 'Espacio de Trabajo eliminado exitosamente');
    }

    public function storeboard(Request $request, $workspace)
    {
        try {
            $validated = $request->validate([
                'title' => 'required'
            ], [
                'title.required' => 'El titulo es requerido',
            ]);
            $board = Board::create([
                'work_space_id' => $workspace,
                'title' => $validated['title'],
                'title_slug' => Str::slug($validated['title'], '-'),
            ]);
            return redirect()->back()->with('success', 'Tablero creado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function renameboard(Request $request)
    {
        try {
            $board = Board::where('work_space_id', $request->workspace_id)->where('title_slug', $request->titleboardid)->first();
            $board->title = $request->title;
            $board->title_slug = Str::slug($request->title, '-');
            $board->save();
            return redirect()->back()->with('success', 'Tablero renombrado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function storeitem(Request $request)
    {
        try {
            $validated = $request->validate([
                'board_id' => 'required',
                'title' => 'required'
            ], [
                'board_id.required' => 'El board es requerido',
                'title.required' => 'El titulo es requerido',
            ]);

            $board = Board::where('title_slug', $validated['board_id'])
            ->where('work_space_id', $request->workspace_id)->first();

            $task = BoardItem::create([
                'work_space_id' => $request->workspace_id,
                'board_id' => $board->id,
                'title' => $validated['title'],
                'start_date' => $request->start_date,
                'due_date' => $request->due_date,
                'start_time' => $request->start_time,
                'due_time' => $request->due_time,
                'description' => $request->description,
                'priority' => $request->priority,
                'badge_text' => $request->priority,
                'badge' => $this->verifyPriority($request->priority),
                'event_calendar' => $request->event_calendar,
                'billable_task' => $request->billable_task,
                'time_billable_task' => $request->time_billable_task,
            ]);

            # validar que la variable de archivos tenga valor
            $archivos = isset($request->attachments) ? $request->attachments : null;
            $url = null;
            if ($archivos != null) {
                foreach ($archivos as $file) {
                    $uploadPath = public_path('/storage/');
                    $extension = $file->getClientOriginalExtension();
                    $uuid = Str::uuid(4);
                    $fileName = $uuid . '.' . $extension;
                    $file->move($uploadPath, $fileName);
                    $url = '/storage/'.$fileName;

                    BoardItemFile::create([
                        'board_item_id' => $task->id,
                        'file' => $url,
                        'filename' => $file->getClientOriginalName(),
                    ]);
                }
            }

            if ($request->event_calendar == 'Si') {
                $this->createEvent($request->title, $request->description, $request->start_date, $request->start_time, $request->due_date, $request->due_time);
            }

            return redirect()->back()->with('success', 'Tarea creada correctamente');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function showitem($id)
    {
        try {
            $task = BoardItem::find($id);
            $files = BoardItemFile::where('board_item_id', $task->id)->get();

            return response()->json(['task' => $task, 'files' => $files]);
        } catch (\Exception $e) {
            return response()->json(['error', $e->getMessage()]);
        }
    }
    public function updateitem(Request $request)
    {
        // dd($request->all());
        try {
            $validated = $request->validate([
                'title' => 'required'
            ]);

            $calendar = '';
            $task = BoardItem::where('work_space_id', $request->workspace_id)
                    ->where('id', $request->board_id)->first();
            $calendar = $task->event_calendar;


            $task->title = $validated['title'];
            $task->start_date = $request->start_date;
            $task->due_date = $request->due_date;
            $task->start_time = $request->start_time;
            $task->due_time = $request->due_time;
            $task->description = $request->description;
            $task->priority = $request->priority;
            $task->badge_text = $request->priority;
            $task->badge = $this->verifyPriority($request->priority);
            $task->event_calendar = $request->event_calendar;
            $task->billable_task = $request->billable_task;
            $task->time_billable_task = $request->time_billable_task;
            $task->save();

            # validar que la variable de archivos tenga valor
            $archivos = isset($request->attachments) ? $request->attachments : null;
            $url = null;
            if ($archivos != null) {
                foreach ($archivos as $file) {
                    $uploadPath = public_path('/storage/');
                    $extension = $file->getClientOriginalExtension();
                    $uuid = Str::uuid(4);
                    $fileName = $uuid . '.' . $extension;
                    $file->move($uploadPath, $fileName);
                    $url = '/storage/'.$fileName;

                    BoardItemFile::create([
                        'board_item_id' => $task->id,
                        'file' => $url,
                        'filename' => $file->getClientOriginalName(),
                    ]);
                }
            }

            if ($calendar == 'No' && $request->event_calendar == 'Si') {
                $this->createEvent($request->title, $request->description, $request->start_date, $request->start_time, $request->due_date, $request->due_time);
            }

            return redirect()->back()->with('success', 'Tarea actualizada correctamente');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

    }

    public function verifyPriority($priority)
    {
        if ($priority == 'Alta') {
            return 'danger';
        } elseif ($priority == 'Media') {
            return 'warning';
        } elseif ($priority == 'Baja') {
            return 'primary';
        } else {
            return 'info';
        }
    }
    public function deleteitem($workspace_id, $id)
    {
        try
        {
            $task = BoardItem::where('work_space_id', $workspace_id)
            ->where('id', $id)->first();
            $task->delete();

            return redirect()->back()->with('success', 'Tarea eliminada correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function moveitem(Request $request)
    {
        try {
            $board = Board::where('title_slug', $request->new_board_id)
            ->where('work_space_id', $request->workspace_id)->first();
            $task = BoardItem::where('work_space_id', $request->workspace_id)->find($request->task_id);
            $task->board_id = $board->id;
            $task->save();

            return response()->json(['success' => 'Tarea movida correctamente']);
        } catch (\Exception $e) {
            return response()->json(['error', $e->getMessage()]);
        }
    }

    public function deleteboard(Request $request)
    {
        try
        {
            $board = Board::where('title_slug', $request->board)
            ->where('work_space_id', $request->workspace_id)->first();
            $board->items()->delete();
            $board->delete();

            return redirect()->back()->with('success', 'Board eliminado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function createEvent($title, $description, $start_date, $start_time, $due_date, $due_time)
    {
        $credentialsPath = storage_path('app/credentials/sistema-oficina-notarial-dc5bd4d1cf83.json');
        $calendarId = 'oficinalegalynotariacsp@gmail.com';

        $client = new Client();
        $client->setAuthConfig($credentialsPath);
        $client->addScope(Calendar::CALENDAR);

        $service = new Calendar($client);

        $event = new Event([
            'summary' => $title,
            'description' => $description,
            'start' => [
                'dateTime' =>  $start_date.'T'. $start_time.':00-04:00',
                'timeZone' => 'America/Puerto_Rico',
            ],
            'end' => [
                'dateTime' =>  $due_date.'T'. $due_time.':00-04:00',
                'timeZone' => 'America/Puerto_Rico',
            ],
            'colorId' => '3', // Elige un color del 1 al 11

        ]);

        $event = $service->events->insert($calendarId, $event);

        return $event;

    }

}
