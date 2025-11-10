<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.roles.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar que se cree bien
        $request->validate(['name'=>'required|unique:roles,name']);
        // Si pasa la validacion, creará el rol
        Role::create(['name'=>$request->name]);
        // Variable de un solo uso para alerta
        session()->flash('swal',
        [
            'icon'=>'success',
            'title'=>'Rol creado correctamente',
            'text'=>'El rol ha sido creado correctamente',
        ]
        );
        // Redireccionar a la vista de roles
        return redirect()->route('admin.roles.index')->with('success','Rol created successfully');
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
    public function edit(Role $role)
    {
        // Restringir la acción para los primeros 4 roles fijos
        if($role->id <= 4){
            session()->flash('swal',
                [
                    'icon'=>'error',
                    'title'=>'Error',
                    'text'=>'No puedes editar este rol',
                ]
            );
            return redirect()->route('admin.roles.index');
        }
        return view('admin.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        // Validar que se inserte bien
        $request->validate(['name'=>'required|unique:roles,name,'. $role->id]);
        // Si el campo no cambio, no actualice
        if($role->name === $request->name){
            session()->flash('swal',
            [
                'icon'=>'info',
                'title'=>'Sin cambios',
                'text'=>'No se detectaron modificaciones',
            ]
            );
            return redirect()->route('admin.roles.edit', $role);
        }
        // Si pasa la validacion, editará el rol
        $role->update(['name'=>$request->name]);
        // Variable de un solo uso para alerta
        session()->flash('swal',
            [
                'icon'=>'success',
                'title'=>'Rol actualizado correctamente',
                'text'=>'El rol ha sido actualizado correctamente',
            ]
        );
        // Redireccionar a la vista de roles
        return redirect()->route('admin.roles.index', $role);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        // Restringir la acción para los primeros 4 roles fijos
        if($role->id <= 4){
            session()->flash('swal',
            [
                'icon'=>'error',
                'title'=>'Error',
                'text'=>'No puedes eliminar este rol',
            ]
            );
            return redirect()->route('admin.roles.index');
        }
        // Borrar el elemento
        $role->delete();
        // Alerta
        session()->flash('swal',
        [
            'icon'=>'success',
            'title'=>'Rol eliminado correctamente',
            'text'=>'El rol ha sido eliminado correctamente',
        ]);
        // Redireccionar a la vista de roles
        return redirect()->route('admin.roles.index');
    }
}
