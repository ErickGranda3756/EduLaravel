<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    /* Crear un perfil cuando se crea un usuario */
    protected static function boot()
    {
        parent::boot();
        /* Asignar perfil al registrar el usuario */
        static::created(function ($user) {
            $user->profile()->create();
        });
    }



    /* Relacion de uno a uno (user - profile) */
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
    /* Relacion de uno a muchos (usuario - articulos) */
    public function articles()
    {
        return $this->hasMany(Article::class);
    }
    /* Relacion de uno a muchos (usuario - comments) */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function adminlte_image(){
        return asset("storage/". Auth::user()->profile->photo);
    }
}
