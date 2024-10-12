<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //listar todos los usuarios
        $users=User::simplePaginate(10);
        return view('admin.users.index', compact('users'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //recuperar el listado de roles
        $roles=Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //Llenar la tabla intermedia
        $user->roles()->sync($request->role);
        return redirect()->route('users.edit',$user)
        ->with('success-update','Rol establecido con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
        $user->delete();
        return redirect()->action([UserController::class,'index'])
        ->with('success-delete','Usuario eliminado con éxito');
    }
}
