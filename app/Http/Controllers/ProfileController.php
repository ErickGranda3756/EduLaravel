<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile)
    {
        return view("subscriber.profiles.edit", compact("profile"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfileRequest $request, Profile $profile)
    {
        /* Guardamos la informacion del usuario */
        $user = Auth::user();
        /* Comporbar si el usuario sube una foto */
        if ($request->hasFile("photo")) {
            /* Eliminar la foto anterior */
            File::delete(public_path("storage/") . $profile->photo);
            /* Guardar la nueva foto */
            $photo = $request["photo"]->store("profiles");
        } else {
            $photo = $user->profile->photo;
        }
        /* Asignar nombre y correo */
        $user->full_name = $request->full_name;
        $user->email = $request->email;
        /* Asignar la foto */
        $user->profile->photo = $photo;
        $user = User::find(Auth::id());
        /* Guardar campos de usuario */
        $user->save();
        /* Guardar campos de perfil */
        $user->profile->save();
        /* Redireccionar al home */
        return redirect()->route("profiles.edit", $user->profile->id);
    }
}
