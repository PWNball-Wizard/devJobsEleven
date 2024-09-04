<?php

namespace App\Livewire;

use App\Events\RealTimeNotification;
use App\Models\Candidato;
use App\Models\User;
use App\Notifications\NuevoCandidato;
use Illuminate\Support\Facades\Broadcast;
use Livewire\Component;

class MuestraVacante extends Component
{
    public $vacante;
    public $usuario;
    public $esVisible = false;

    protected $listeners = ['mostrarModal', 'ocultarModal', 'postularVacante'];

    /* public function mount()
    {
        $this->usuario = User::find($this->vacante->user_id);
    } */

    public function render()
    {
        return view('livewire.muestra-vacante', ['usuario' => $this->usuario]);
    }

    public function mostrarModal()
    {
        $this->esVisible = !$this->esVisible;
    }

    public function ocultarModal()
    {
        $this->esVisible = false;
    }

    public function postularVacante($nombre_curriculum)
    {
        /* Candidato::create([
            'vacante_id' => $this->vacante->id,
            'curriculum' => $nombre_curriculum,
            'user_id' => auth()->user()->id,
        ]); */

        //! $this->vacante->user->notify(new NuevoCandidato($this->vacante->id, $this->vacante->titulo, auth()->user()->id));
        $datos = [
            'vacante_id' => $this->vacante->id,
            'titulo' => $this->vacante->titulo,
            'user_id' => auth()->user()->id,
        ];
        $usuario = $this->vacante->user->id;
        //event(new RealTimeNotification($datos));
        RealTimeNotification::dispatch($datos);
        //Broadcast(new RealTimeNotification($datos))->toOthers();
        //$this->dispatch('RealTimeNotification', $this->vacante);
        //!return response()->json(['status' => 'Message sent!']);

        //! cerramos el modal
        $this->ocultarModal();
        //! Mandamos en la sesion un mensaje de exito
        session()->flash('success', 'Te postulaste con exito a: ' . $this->vacante->titulo);
        //! Redireccionamos al usuario a la pagina de inicio
        return redirect()->route('candidatos.index');
    }
}
