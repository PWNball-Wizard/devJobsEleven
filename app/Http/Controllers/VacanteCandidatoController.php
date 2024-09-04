<?php

namespace App\Http\Controllers;

use App\Models\Vacante;
use Illuminate\Http\Request;

class VacanteCandidatoController extends Controller
{
    public function index(Vacante $vacante)
    {
        return view('vacantes.candidatos.index', ['vacante' => $vacante]);
    }

    public function show() {}

    public function edit() {}

    public function create(/* Vacante $vacante */) {}
}
