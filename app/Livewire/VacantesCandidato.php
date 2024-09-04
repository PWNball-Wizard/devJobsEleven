<?php

namespace App\Livewire;

use App\Models\Vacante;
use Livewire\Component;

class VacantesCandidato extends Component
{

    public $vacantes;
    public $candidatos;

    public function mount(){
        //! Pluck es un método que se utiliza para obtener una lista de valores de una columna específica de una colección.
        
        $this->candidatos = auth()->user()->candidatos->pluck('vacante_id');

        //! Obtenemos las vacantes que estan publicadas menos las que tenemos en la variable candidatos
        //! es decir las que ya hemos aplicado

        $this->vacantes = Vacante::where('publicado', 1)->whereNotIn('id', $this->candidatos)->get();

        //$this->vacantes = Vacante::where('publicado', 1)->get();
    }

    public function render()
    {
        return view('livewire.vacantes-candidato');
    }
}
