<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreMateriaRequest;
use App\Http\Requests\UpdateMateriaRequest;

class MateriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
       if ($request->ajax()) {
            $data = Materia::all();
            return DataTables::of($data)
                ->addColumn('actions', function ($data) {
                    return view('materias.partials.actions', ['id' => $data->id]);
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('materias.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('materias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMateriaRequest $request)
    {
        $materia = Materia::create(['name' => Str::upper($request->name)]);
        return redirect()->route('materias.index')->with('success', 'El registro se ha creado exitosamente.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($materia)
    {
        $data = Materia::find($materia);
        return view('materias.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMateriaRequest $request, $materia)
    {
        $materia = Materia::find($materia);
        $materia->name = Str::upper($request->name);
        $materia->save();
        return redirect()->route('materias.index')->with('success', 'El registro se ha actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($materia)
    {
        $materia = Materia::find($materia);
        $materia->delete();
        return redirect()->route('materias.index')->with('success', 'El registro se ha eliminado exitosamente.');
    }
}
