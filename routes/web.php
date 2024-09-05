<?php

use App\Http\Controllers\CandidatoController;
use App\Http\Controllers\FirebaseNotificationController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PostulacionController;
use App\Http\Controllers\PostulanteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VacanteCandidatoController;
use App\Http\Controllers\VacanteController;
use Illuminate\Support\Facades\Route;

//$ Inicio de la aplicacion - Pantalla principal de los candidatos NUEVO
Route::get('/', [CandidatoController::class, 'index'])->middleware(['auth', 'verified'])->name('candidatos.index');

//$ Pantalla principal de los reclutadores
Route::get('/vacantes', [VacanteController::class, 'index'])->middleware(['auth', 'verified', 'rol.reclutador'])->name('vacantes.index');
//! create es diferente a store, create se refiere a la vista para crear una nueva vacante, es decir el formulario
//! store es el metodo que se encarga de guardar la vacante en la base de datos una vez que se envia el formulario
//! Pantallas de reclutadores
Route::get('/vacantes/create', [VacanteController::class, 'create'])->middleware(['auth', 'verified'])->name('vacantes.create');
Route::get('/vacantes/{vacante}/edit', [VacanteController::class, 'edit'])->middleware(['auth', 'verified'])->name('vacantes.edit');
Route::get('/vacantes/{vacante}', [VacanteController::class, 'show'])->name('vacantes.show');

//$ Lista de candidatos
Route::get('/{vacante}/candidatos', [VacanteCandidatoController::class, 'index'])->middleware(['auth', 'verified', 'rol.reclutador'])->name('vacantes.candidatos.index');

//$ Dashboard para candidatos anterior
//! Route::get('/candidatos', [CandidatoController::class, 'index'])->middleware(['auth', 'verified'])->name('candidatos.index');

//$ Postulaciones del candidato
Route::get('/candidatos/postulaciones', [PostulacionController::class, 'index'])->middleware(['auth', 'verified'])->name('postulaciones.index');
//Route::get('/postulantes/{vacante}', [CandidatoController::class, 'create'])->middleware(['auth', 'verified'])->name('candidatos.create');

//$ Panel de notificaciones
Route::get('/notificaciones', NotificationController::class)->middleware(['auth', 'verified', 'rol.reclutador'])->name('notificaciones.index');

/* Route::put('update-device-token', [FirebaseNotificationController::class, 'updateDeviceToken']);
Route::post('send-fcm-notification', [FirebaseNotificationController::class, 'sendFcmNotification']); */

//$ Configuraciones del perfil del usuario
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

require base_path('routes/channels.php');
