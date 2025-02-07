<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Client;
use App\Models\Juzgado;
use App\Models\Materia;
use App\Models\WorkSpace;
use Illuminate\Http\Request;
use App\Models\MedioContacto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Client::select('id',
                DB::raw('CONCAT(firstname, " ", second_name, " ", lastname, " ", second_surname) as fullname'),
                'phone', 'email')
                ->get();
            return DataTables::of($data)
                ->addColumn('actions', function ($data) {
                    return view('clientes.partials.actions', ['id' => $data->id]);
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('clientes.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $medios = MedioContacto::all();
        $juzgados = Juzgado::all();
        $materias = Materia::all();
        return view('clientes.create', compact('medios', 'materias', 'juzgados'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClienteRequest $request)
    {
        $data = $request->all();
        $client = Client::create($data);

        $workspace = WorkSpace::create([
            'client_id' => $client->id,
            'user_id' => Auth::user()->id,
            'title' => 'Tablero '.$client->firstname .' '.$client->second_name.' '.$client->lastname.' '.$client->second_surname,
            'description' => $request->description,
        ]);

        Board::create(['work_space_id' => $workspace->id,'title' => 'Gestiones o Tareas', 'title_slug' => 'gestiones-o-tareas']);
        Board::create(['work_space_id' => $workspace->id,'title' => 'Pendientes', 'title_slug' => 'pendientes']);
        Board::create(['work_space_id' => $workspace->id,'title' => 'En Proceso', 'title_slug' => 'en-proceso']);
        Board::create(['work_space_id' => $workspace->id,'title' => 'En Revision', 'title_slug' => 'en-revision']);
        Board::create(['work_space_id' => $workspace->id,'title' => 'Finalizadas', 'title_slug' => 'finalizadas']);

        return redirect()->route('clientes.index')->with('success', 'El registro se ha creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($cliente)
    {
        $data = Client::find($cliente);
        return view('clientes.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($cliente)
    {
        $data = Client::find($cliente);
        $medios = MedioContacto::all();
        $juzgados = Juzgado::all();
        $materias = Materia::all();
        return view('clientes.edit', compact('data', 'medios', 'juzgados', 'materias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClienteRequest $request, $cliente)
    {
        $data = $request->all();
        $c = Client::find($cliente);
        $c->update($data);
        return redirect()->route('clientes.index')->with('success', 'El registro se ha actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $cliente)
    {
        $data = $cliente;
        $data = $cliente->delete();
        return redirect()->route('cliente.index')->with('success', 'El registro se ha eliminado exitosamente.');
    }
}
