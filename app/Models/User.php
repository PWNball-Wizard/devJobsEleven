<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

//! MustVerifyEmail es una interfaz que se implementa en el modelo de usuario para que Laravel pueda enviar correos electrónicos de verificación
//! a los usuarios que se registran en la aplicación. La interfaz MustVerifyEmail se importa en el modelo de usuario y se implementa en la clase User.
class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'rol', //! Agregar el campo rol a los atributos que se pueden asignar masivamente
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

    public function vacantes()
    {
        return $this->hasMany(Vacante::class);
    }

    public function candidatos()
    {
        return $this->hasMany(Candidato::class);
    }
}
