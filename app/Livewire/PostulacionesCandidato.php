<?php

namespace App\Livewire;

use Livewire\Component;

class PostulacionesCandidato extends Component
{
    public $postulaciones;
    public $categorias;
    public $salarios;

    public function mount()
    {
        //! Para acceder a las vacantes a las que se ha postulado un candidato, se accede a la relación candidatos de la clase User
        //! $this->postulaciones = auth()->user()->candidatos;

        //! si queremos acceder ademas a las tablas relacionadas con la tabla candidatos, usamos with para cargar las relaciones de la tabla candidatos
        $this->postulaciones = auth()->user()->candidatos()->with('vacante.categoria', 'vacante.salario')->get();
    }

    public function render()
    {
        return view('livewire.postulaciones-candidato');
    }
}
