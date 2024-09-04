<?php

namespace App\Livewire;

use Livewire\Component;

class ModalEliminar extends Component
{

    public $vacante;

    public function eliminaVacante()
    {
        //! lo que hace la linea de abajo es que emite un evento con dispatch
        //! el primer parametro es el nombre del evento que se va a emitir, en este caso es 'eliminarVacante'
        //! el segundo parametro es lo que se va a enviar con el evento, en este caso se envia la vacante
        $this->dispatch('eliminarVacante', $this->vacante);
    }

    public function render()
    {
        return view('livewire.modal-eliminar');
    }
}
