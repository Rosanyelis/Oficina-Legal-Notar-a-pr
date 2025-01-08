<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\MedioContacto;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreMedioContactoRequest;
use App\Http\Requests\UpdateMedioContactoRequest;

class MedioContactoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
       if ($request->ajax()) {
            $data = MedioContacto::all();
            return DataTables::of($data)
                ->addColumn('actions', function ($data) {
                    return view('medios-contacto.partials.actions', ['id' => $data->id]);
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('medios-contacto.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('medios-contacto.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMedioContactoRequest $request)
    {
        $medioContacto = MedioContacto::create(['name' => Str::upper($request->name)]);
        return redirect()->route('medios-contacto.index')->with('success', 'El registro se ha creado exitosamente.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($medioContacto)
    {
        $data = MedioContacto::find($medioContacto);
        return view('medios-contacto.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMedioContactoRequest $request, $medioContacto)
    {
        $medioContacto = MedioContacto::find($medioContacto);
        $medioContacto->name = Str::upper($request->name);
        $medioContacto->save();
        return redirect()->route('medios-contacto.index')->with('success', 'El registro se ha actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($medioContacto)
    {
        $medioContacto = MedioContacto::find($medioContacto);
        $medioContacto->delete();
        return redirect()->route('medios-contacto.index')->with('success', 'El registro se ha eliminado exitosamente.');
    }
}
