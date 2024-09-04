<?php

namespace App\Livewire;

use App\Models\Categoria;
use App\Models\Salario;
use App\Models\Vacante;
use Dotenv\Exception\ValidationException;
use Illuminate\Container\Attributes\Auth;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class CrearVacante extends Component
{
    public $titulo;
    public $salario;
    public $categoria;
    public $empresa;
    public $ultimo_dia;
    public $descripcion;
    public $imagen;
    public $imagenValida = false;
    /* public $user; */

    //! $rules es una propiedad que nos permite definir las reglas de validación de los campos del formulario en Livewire
    protected $rules = [
        'titulo' => 'required|string',
        'salario' => 'required',
        'categoria' => 'required',
        'empresa' => 'required',
        //! para validar fechas podemos hacerlo de la siguiente forma 'ultimo_dia' => 'required|date|after:today'
        //! quiero validar que una hora sea mayor a la actual y que sea minimo de 30 minutos posterior a la hora actual
        //! 'hora' => 'required|date_format:H:i|after:'.now()->addMinutes(30)->format('H:i'),
        'ultimo_dia' => 'required',
        'descripcion' => 'required',
        'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', //! para indicar que un parametro es opcional se coloca nullable
        //! Si queremos subir imagenes de tipos especificos podemos hacerlo de la siguiente forma
    ];
    //! wire:submit.prevent="submit" es una directiva de Livewire que nos permite prevenir el comportamiento por defecto de un formulario al enviarlo

    //! WithFileUploads es un trait de Livewire que nos permite subir archivos al servidor
    use WithFileUploads;

    public function crearVacante()
    {
        /* $usuario = auth()->user()->id;
        dd($usuario); */
        //! necesitamos llamar $rules al arreglo de reglas de validación
        //! de esta forma cuando hagamos $this->validate() livewire sabra de manera automatica que reglas de validación aplicar
        $datos = $this->validate();

        //! Guardar la imagen en el servidor
        if ($this->imagen) {
            $imagen = $this->imagen->store('public/vacantes');
            $nombre_imagen = str_replace('public/vacantes/', '', $imagen);
        }

        //! en livewire no podemos acceder a la propiedad auth()->user() por lo que debemos pasarla como parametro en el componente
        /* dd($this->user->id); */

        Vacante::create([
            //! Otra forma de hacerlo es $this->titulo
            'titulo' => $this->titulo,
            'salario_id' => $datos['salario'],
            'categoria_id' => $datos['categoria'],
            'empresa' => $datos['empresa'],
            'ultimo_dia' => $datos['ultimo_dia'],
            'descripcion' => $datos['descripcion'],
            'imagen' => $nombre_imagen ?? null,
            'user_id' => auth()->user()->id,
        ]);

        //! Mostrar un mensaje de éxito
        session()->flash('success', 'La vacante se creó correctamente');
        //! Redireccionar al usuario a la página de inicio
        return redirect()->route('vacantes.index');
    }

    //! En laravel cuando colocas updated seguido del nombre de una propiedad, Livewire automáticamente ejecuta el método correspondiente cada vez que esa propiedad cambia
    //! Ejem
    public function updatedImagen()
    {
        //! Validar que el archivo subido sea una imagen antes de intentar la previsualización
        $this->validate([
            'imagen' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $this->imagenValida = true;
    }

    public function render()
    {
        //! all() es un metodo de Eloquent que nos permite obtener todos los registros de una tabla en la base de datos
        $salarios = Salario::all();
        $categorias = Categoria::all();

        return view('livewire.crear-vacante', [
            'salarios' => $salarios,
            'categorias' => $categorias,
        ]);
    }
}
