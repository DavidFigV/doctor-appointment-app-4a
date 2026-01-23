<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.Users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.Users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'id_number' => 'required|string|min:5|max:20|regex:/^[A-Za-z0-9\-]+$/|unique:users',
            'phone' => 'nullable|digits_between:7,15',
            'address' => 'nullable|string|min:3|max:255',
            'role_id' => 'required|exists:roles,id'
        ]);
        $user = User::create($data);
        $user->roles()->attach($data['role_id']);
        session()->flash('swal', [
            'icon'=>'success',
            'title'=>'Usuario creado',
            'text'=>'El usuario ha sido creado correctamente',
        ]);
        return redirect()->route('admin.users.index')->with('success','User created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.Users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'id_number' => 'required|string|min:5|max:20|regex:/^[A-Za-z0-9\-]+$/|unique:users,id_number,'.$user->id,
            'phone' => 'nullable|digits_between:7,15',
            'address' => 'nullable|string|min:3|max:255',
            'role_id' => 'required|exists:roles,id'
        ]);

        $user->update($data);

        //Si el usuario quiere editar su contraseña, que se actualice
        if ($request->filled('password')) {
            $user->password = ($request->password);
            $user->save();
        }

        $user->roles()->sync($data['role_id']);

        session()->flash('swal', [
            'icon'=>'success',
            'title'=>'Usuario actualizado',
            'text'=>'El usuario ha sido actualizado correctamente',
        ]);
        return redirect()->route('admin.users.edit', $user->id)->with('success','User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // No permitir que el usuario logueado se borre a sí mismo
        if(Auth::user()->id === $user->id){
            session()->flash('swal', [
                'icon'=>'error',
                'title'=>'Error',
                'text'=>'No puedes eliminar tu propio usuario',
            ]);
            abort(403, 'No puedes eliminar tu propio usuario');
        }

        // Eliminar roles asociados al usuario
        $user->roles()->detach();
        // Eliminar el usuario
        $user->delete();

        session()->flash('swal', [
            'icon'=>'success',
            'title'=>'Usuario eliminado',
            'text'=>'El usuario ha sido eliminado correctamente',
        ]);
        return redirect()->route('admin.users.index')->with('success','User deleted successfully');
    }
}
