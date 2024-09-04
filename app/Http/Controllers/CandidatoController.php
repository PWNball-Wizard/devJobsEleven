<?php

namespace App\Http\Controllers;

use App\Models\Candidato;
use App\Models\Vacante;
use Illuminate\Http\Request;

class CandidatoController extends Controller
{
    //! crear los metodos index, show, edit, create
    public function index()
    {
        $this->authorize('viewAny', Candidato::class);

        return view('candidatos.index');
    }

    public function show()
    {
        
    }

    public function edit()
    {
        
    }

    public function create(Vacante $vacante) {}
}
