<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //! Permission es un modelo que viene con el paquete spatie/laravel-permission y se usa para crear permisos en la base de datos
        //! create es un metodo estatico que se usa para crear un nuevo permiso en la base de datos
        
        /* Permission::create(['name' => 'vacantes.index']);
        Permission::create(['name' => 'vacantes.create']);
        Permission::create(['name' => 'vacantes.edit']);
        Permission::create(['name' => 'vacantes.show']); 
        Permission::create(['name' => 'candidatos.index']);
        Permission::create(['name' => 'candidatos.create']);
        Permission::create(['name' => 'candidatos.edit']);
        Permission::create(['name' => 'candidatos.show']);
        Permission::create(['name' => 'postulaciones.index']);
        Permission::create(['name' => 'postulaciones.create']);
        Permission::create(['name' => 'postulaciones.edit']);
        Permission::create(['name' => 'postulaciones.show']); */

        // Crear un rol
        $candidato = Role::create(['name' => 'Candidato']);
        $reclutador = Role::create(['name' => 'Reclutador']);

        // Asignar el permiso al rol
        $candidato->givePermissionTo('candidatos.index');
        $candidato->givePermissionTo('candidatos.create');
        $candidato->givePermissionTo('candidatos.edit');
        $candidato->givePermissionTo('candidatos.show');
        $candidato->givePermissionTo('postulaciones.index');
        $candidato->givePermissionTo('postulaciones.create');
        $candidato->givePermissionTo('postulaciones.edit');
        $candidato->givePermissionTo('postulaciones.show');

        $reclutador->givePermissionTo('vacantes.index');
        $reclutador->givePermissionTo('vacantes.create');
        $reclutador->givePermissionTo('vacantes.edit');
        $reclutador->givePermissionTo('vacantes.show');


        $usuarios_candidatos = User::where('rol', 1)->get();

        foreach ($usuarios_candidatos as $user) {
            // Asignar un rol al usuario
            $user->assignRole('Candidato');

            // Asignar un permiso directamente al usuario
            $user->givePermissionTo('candidatos.index');
            $user->givePermissionTo('candidatos.create');
            $user->givePermissionTo('candidatos.edit');
            $user->givePermissionTo('candidatos.show');
            $user->givePermissionTo('postulaciones.index');
            $user->givePermissionTo('postulaciones.create');
            $user->givePermissionTo('postulaciones.edit');
            $user->givePermissionTo('postulaciones.show');
        }

        $usuarios_reclutadores = User::where('rol', 2)->get();
        foreach ($usuarios_reclutadores as $user) {
            // Asignar un rol al usuario
            $user->assignRole('Reclutador');

            // Asignar un permiso directamente al usuario
            $user->givePermissionTo('candidatos.index');
            $user->givePermissionTo('candidatos.create');
            $user->givePermissionTo('candidatos.edit');
            $user->givePermissionTo('candidatos.show');
            $user->givePermissionTo('postulaciones.index');
            $user->givePermissionTo('postulaciones.create');
            $user->givePermissionTo('postulaciones.edit');
            $user->givePermissionTo('postulaciones.show');
        }
    }
}
