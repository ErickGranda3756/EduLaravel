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
        //Asignar campos adicionales 
        $user->profile->profession = $request->profession;
        $user->profile->about = $request->about;
        $user->profile->photo = $photo;
        $user->profile->twitter = $request->twitter;
        $user->profile->linkedin = $request->linkedin;
        $user->profile->facebook = $request->facebook;

        $user = User::find(Auth::id());
        /* Guardar campos de usuario */
        $user->save();
        /* Guardar campos de perfil */
        $user->profile->save();
        /* Redireccionar al home */
        return redirect()->route("profiles.edit", $user->profile->id);
    }
}
