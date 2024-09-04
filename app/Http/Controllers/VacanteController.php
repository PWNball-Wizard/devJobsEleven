<?php

namespace App\Http\Controllers;

use App\Models\Vacante;
use Illuminate\Http\Request;

class VacanteController extends Controller
{
    //! Metodo para mostrar todas las vacantes
    public function index()
    {
        //! Le podemos pasar como parametro un modelo a la funcion authorize
        //! en este caso esto indica que solo los usuarios con rol 2 pueden acceder a este modelo
        $this->authorize('viewAny', Vacante::class);

        //! para evitar que un usuario con rol 1 no pueda ver

        return view('vacantes.index');
    }

    //! Metodo para crear una nueva vacante
    public function create()
    {
        
        $this->authorize('create', Vacante::class);

        return view('vacantes.create');
    }

    //! Metodo para guardar una nueva vacante
    /* public function store(Request $request)
    {
        //
    } */

    /**
     * Display the specified resource.
     */
    public function show(Vacante $vacante)
    {
        return view('vacantes.show', ['vacante' => $vacante]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(/* string $id, */Vacante $vacante)
    {
        $this->authorize('update', $vacante);

        return view('vacantes.edit', ['vacante' => $vacante]);
    }

    //! Update, destroy y store no se usan en Livewire, se usan en controladores de Laravel
    /**
     * Update the specified resource in storage.
     */
    /* public function update(Request $request, string $id)
    {
        //
    } */

    /**
     * Remove the specified resource from storage.
     */
    /* public function destroy(string $id)
    {
        //
    } */
}
