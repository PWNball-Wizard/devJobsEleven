<?php

namespace App\Livewire;

use Livewire\Component;

class ListadoCandidatos extends Component
{
    public $vacante;
    public $candidatos;

    public function mount()
    {
        $this->candidatos = $this->vacante->candidatos;
        //dd('Candidatos'. $this->candidatos);
    }

    public function render()
    {
        return view('livewire.listado-candidatos');
    }
}
