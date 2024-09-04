<?php

namespace App\Livewire;

use App\Models\Vacante;
use Livewire\Component;
use InteractsWithConfirmationModal;
use Laravel\Reverb\Events\MessageReceived;
use Livewire\Attributes\On;

class MostrarVacantes extends Component
{
    //! $listeners es un arreglo que se usa para escuchar eventos emitidos desde otros componentes de livewire
    protected $listeners = ['eliminarVacante', 'ocultaModal', /* 'echo:notificaciones,Enviadas' => 'Enviadas' */];

    //#[On('RealTimeNotification')]
    //! deben tener el mismo nombre que el evento que se emite desde el componente, en este caso el evento que se emite
    //! desde el componente ModalEliminar es 'eliminarVacante', por lo que el metodo que se va a ejecutar cuando se emita
    //! ese evento debe tener el mismo nombre que el evento que se emite desde el componente ModalEliminar
    //! por ejemplo en el ModalEliminar emito el evento 'eliminarVacante', en este componente agrego a los $listeners el evento
    //! 'eliminarVacante', en este componente debo tener un metodo llamado 'eliminarVacante' que se va a ejecutar cuando se emita
    //! el evento 'eliminarVacante' desde el componente ModalEliminar

    public $esVisible = false;
    public array $notificaciones = [];


    public function muestraModal()
    {
        $this->esVisible = true;
    }

    public function ocultaModal()
    {
        $this->esVisible = false;
    }

    public function eliminarVacante(Vacante $vacante)
    {
        //dd($vacante->titulo);
        $vacante->delete();
        $this->ocultaModal();
        //!Agregar un mensaje flash
        //session()->flash('success', 'La vacante se elimino correctamente');
    }

    #[On('echo:notificaciones,.Enviadas')]
    public function Enviadas($datos)
    {
        dd($datos);
        $this->notificaciones[] = $datos;
    }

    //! Evento emitido dede el componente, con wire:click="prueba({{ $vacante->id }})"
    /* public function prueba($vacanteId)
    {
        dd('Vacante ID: ' . $vacanteId);
    } */

    //En laravel 11 para emitir eventos se usa el metodo emitUp, en versiones anteriores se usa el metodo emit

    public function render()
    {

        //dd(auth()->user()->vacantes->categoria);

        //! para consultar las vacantes que tiene el usuario autenticado se puede hacer de muchas maneras, una es usando las relaciones
        //! que se definieron en los modelos, en este caso se puede acceder a las vacantes de un usuario a traves de la relacion que 
        //! se definio en el modelo User: auth()->user()->vacantes
        //! las relaciones no pueden paginarse, por lo que si se desea paginar los resultados se debe hacer la consulta directamente en la base de datos
        $vacantes = auth()->user()->vacantes()->paginate(10);
        //! cuando usas vacantes() estas usando la relacion que se definio en el modelo User, si usas vacantes estas accediendo a la propiedad
        //! al usar la relacion con () podemos usar metodos de consulta como paginate, get, first, etc.
        //! al usar la propiedad solo estamos accediendo a los datos de la relacion, por lo que no podemos usar metodos de consulta

        //!otra forma de paginar es usando where, de esta forma se puede hacer una consulta a la base de datos para obtener las vacantes
        //! que tiene el usuario autenticado: Vacante::where('user_id', auth()->user()->id)->paginate(10);

        //! Otra forma de hacerlo es consultando directamente en la base de datos, para esto se puede hacer uso de la clase Vacante
        //! que se importa al inicio del archivo, de esta forma se puede hacer una consulta a la base de datos para obtener las vacantes
        //! que tiene el usuario autenticado: Vacante::where('user_id', auth()->user()->id)->get();
        //! ademas de where existen otros metodos como whereIn, whereBetween, whereNull, whereNotNull, otros son orWhere, whereHas, o whereDoesntHave

        return view('livewire.mostrar-vacantes', [
            'vacantes' => $vacantes
        ]);
    }
}
