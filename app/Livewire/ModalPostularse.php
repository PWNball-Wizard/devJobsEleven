<?php

namespace App\Livewire;

use App\Models\Candidato;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class ModalPostularse extends Component
{
    use WithFileUploads;

    public $vacante;
    public $curriculum;

    protected $rules = [
        'curriculum' => 'required|mimes:pdf|max:1024'
    ];

    public function updatedCurriculum()
    {
        $this->validate([
            'curriculum' => 'required|mimes:pdf|max:1024'
        ]);
    }

    public function postularDispatch()
    {
        $this->validate();

        if ($this->curriculum) {
            $curriculum = $this->curriculum->store('public/candidatos');
            $nombre_curriculum = str_replace('public/candidatos/', '', $curriculum);

            //dd($nombre_curriculum);
        }

        /* Candidato::create([
            'vacante_id' => $this->vacante->id,
            'user_id' => auth()->user()->id,
            'curriculum' => $nombre_curriculum
        ]); */

        $this->dispatch('postularVacante', $nombre_curriculum);
    }

    public function render()
    {
        return view('livewire.modal-postularse');
    }
}
