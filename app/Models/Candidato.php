<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidato extends Model
{
    use HasFactory;

    protected $fillable = [
        'vacante_id',
        'user_id',
        'curriculum'
    ];

    //! Un candidato pertenece a una vacante
    public function vacante()
    {
        //!belongsTo se usa cuando la llave foranea esta en la tabla actual, es decir si en esta tabla tenemos
        //!la llave foranea de la otra tabla usamos belongsTo
        //!hasMany se usa cuando la llave primaria esta en esta tabla y la llave foranea esta en la otra tabla
        //! otra relacion es hasOne, hasMany, belongsTo, belongsToMany, morphOne, morphMany, morphTo, morphToMany, and morphedByMany
        //! hasOne es el inverso de belongsTo es decir si en esta tabla tenemos la llave primaria y en la otra tabla la llave foranea
        //! por ejemplo un usuario tiene un perfil, en la tabla de perfiles tendriamos la llave foranea del usuario
        return $this->belongsTo(Vacante::class);
    }

    //! Un candidato pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
