<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\Article;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    /* Proteger rutas */
    public function __construct()
    {
        /* Proteger las rutas */
        $this->middleware('auth');
    }
    /*  */
    public function store(Profile $profile)
    {
        $article = Article::where([
            ['user_id', $profile->user_id],
            ['status', '1']
        ])->simplePaginate(8);
        return view(
            'subscriber.profiles.show',
            compact('profile', 'articles')
        );
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile)
    {
        // Validar que el usuario sea el autor del perfil
        $this->authorize('view', $profile);
        return view("subscriber.profiles.edit", compact("profile"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfileRequest $request, Profile $profile)
    {
        // Validar que el usuario sea el autor del perfil
        $this->authorize('update', $profile);
        // Obtén al usuario autenticado
        $user = Auth::user();

        // Comprobar si el usuario sube una foto
        if ($request->hasFile("photo")) {
            // Eliminar la foto anterior si existe
            if ($profile->photo) {
                File::delete(public_path("storage/") . $profile->photo);
            }

            // Guardar la nueva foto
            $photo = $request->file('photo')->store('profiles', 'public');
        } else {
            // Si no hay nueva foto, mantener la foto actual
            $photo = $profile->photo;
        }

        // Asignar los valores actualizados al usuario
        $user->full_name = $request->full_name;
        $user->email = $request->email;
        $user->save(); // Guarda los cambios del usuario

        // Asignar valores adicionales al perfil
        $profile->photo = $photo;
        $profile->profession = $request->profession;
        $profile->about = $request->about;
        $profile->twitter = $request->twitter;
        $profile->linkedin = $request->linkedin;
        $profile->facebook = $request->facebook;
        $profile->save(); // Guarda los cambios del perfil

        // Redireccionar con mensaje de éxito
        return redirect()->route("profiles.edit", $profile->id)->with('success', 'Perfil actualizado correctamente');
    }
}
