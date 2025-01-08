<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUser;
use Yajra\DataTables\DataTables;
use App\Http\Requests\UpdateUser;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = User::where('name', '!=', 'Desarrolladora')->get();
        return view('users.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::where('name', '!=', 'Desarrollador')->get();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUser $request)
    {
        $data = $request->all();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = bcrypt($request->password);
        $user = User::create($data);
        $user->assignRole($request->rol);
        return redirect()->route('users.index')->with('success', 'El registro se ha creado exitósamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = User::find($id);
        return view('users.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = User::find($id);
        $roles = Role::where('name', '!=', 'Desarrollador')->get();
        return view('users.edit', compact('data', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password){
            $user->password = $request->password;
        }
        foreach ($user->getRoleNames() as $item) {
            $user->removeRole($item);
        }
        $user->assignRole($request->rol);
        $user->save();
        return redirect()->route('user.index')->with('success', 'El registro se ha actualizado exitósamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        if (empty($user)) {
            return redirect()->back()->with('error', 'El registro no existe.');
        }
        if ($user->status == 'Activo') {
            $user->status = 'Inactivo';
            $user->save();
            return redirect()->back()->with('success', 'El registro se desactivó con éxito.');
        }
        if ($user->status == 'Inactivo'){
            $user->status = 'Activo';
            $user->save();
            return redirect()->back()->with('success', 'El registro se activó con éxito.');
          }
    }
}
