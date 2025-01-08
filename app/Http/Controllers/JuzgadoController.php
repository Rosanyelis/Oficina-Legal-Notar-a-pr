<?php

namespace App\Http\Controllers;

use App\Models\Juzgado;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreJuzgadoRequest;
use App\Http\Requests\UpdateJuzgadoRequest;

class JuzgadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Juzgado::all();
            return DataTables::of($data)
                ->addColumn('actions', function ($data) {
                    return view('juzgados.partials.actions', ['id' => $data->id]);
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('juzgados.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('juzgados.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJuzgadoRequest $request)
    {
        $juzgado = Juzgado::create(['name' => Str::upper($request->name)]);
        return redirect()->route('juzgado.index')->with('success', 'El registro se ha creado exitosamente.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($juzgado)
    {
        $data = Juzgado::find($juzgado);
        return view('juzgados.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJuzgadoRequest $request, $juzgado)
    {
        $juzgado = Juzgado::find($juzgado);
        $juzgado->name = Str::upper($request->name);
        $juzgado->save();
        return redirect()->route('juzgado.index')->with('success', 'El registro se ha actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($juzgado)
    {
        $juzgado = Juzgado::find($juzgado);
        $juzgado->delete();
        return redirect()->route('juzgado.index')->with('success', 'El registro se ha eliminado exitosamente.');
    }
}
