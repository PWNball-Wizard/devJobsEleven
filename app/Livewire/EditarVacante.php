<?php

namespace App\Livewire;

use App\Models\Categoria;
use App\Models\Salario;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class EditarVacante extends Component
{
    public $vacante;
    public $titulo;
    public $ultimo_dia;
    public $empresa;
    public $descripcion;
    public $imagen;
    public $salarios;
    public $categorias;
    public $categoria;
    public $salario;
    public $imagenValida = false;

    use WithFileUploads; //! WithFileUploads es un trait de Livewire que nos permite subir archivos al servidor

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
        //'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        //! Si queremos subir imagenes de tipos especificos podemos hacerlo de la siguiente forma
    ];

    public function mount()
    {
        $this->salarios = Salario::all();
        $this->categorias = Categoria::all();
        $this->titulo = $this->vacante->titulo;
        $this->ultimo_dia = $this->vacante->ultimo_dia->format('Y-m-d');
        $this->empresa = $this->vacante->empresa;
        $this->descripcion = $this->vacante->descripcion;
        $this->imagen = $this->vacante->imagen;
        $this->categoria = $this->vacante->categoria_id;
        $this->salario = $this->vacante->salario_id;
    }

    public function updatedImagen()
    {
        $this->validate([
            'imagen' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $this->imagenValida = true;
    }

    public function render()
    {
        //dd($this->vacante);
        return view('livewire.editar-vacante', ['vacante' => $this->vacante, 'categorias' => $this->categorias, 'salarios' => $this->salarios]);
    }

    public function editarVacante()
    {
        //! para editar la vacante usamos el metodo update de Eloquent
        $this->validate();

        if ($this->imagenValida) {
            $imagen = $this->imagen->store('public/vacantes');
            $nombre_imagen = str_replace('public/vacantes/', '', $imagen);
        }
        //! $this->imagen = $nombre_imagen;

        //! podemos hacerlo de la siguiente forma usando la vacante que se paso como parametro al componente y accediendo a la propiedad update
        $this->vacante->update([
            'titulo' => $this->titulo,
            'ultimo_dia' => $this->ultimo_dia,
            'empresa' => $this->empresa,
            'descripcion' => $this->descripcion,
            //! el operador ?? se usa para asignar un valor por defecto en caso de que la variable no tenga un valor asignado
            'imagen' => $nombre_imagen ?? $this->imagen,
            'categoria_id' => $this->categoria,
            'salario_id' => $this->salario
            //! el operador ternario en php se coloca de la siguiente forma: $variable = (condicion) ? valor_si_es_verdadero : valor_si_es_falso
            //! tambien existe el operador null coalescing que se coloca de la siguiente forma: $variable = $variable ?? 'valor_por_defecto'
            //! tambien existe otro operador que se llama nullsafe que se coloca de la siguiente forma: $variable = $variable?->propiedad
            //! el operator nullsafe se usa para acceder a propiedades de un objeto en caso de que el objeto sea null
            //! tambien existe el operador de fusion null que se coloca de la siguiente forma: $variable = $variable1 ?? $variable2 ?? $variable3
            //! fusion null se usa para asignar el primer valor que no sea null a la variable
        ]);

        session()->flash('success', 'La vacante se actualizo correctamente');

        return redirect()->route('vacantes.index');

        //! o tambien se puede hacer lo siguiente
        /* $this->vacante->titulo = $this->titulo;
        $this->vacante->ultimo_dia = $this->ultimo_dia;
        $this->vacante->empresa = $this->empresa;
        $this->vacante->descripcion = $this->descripcion;
        $this->vacante->imagen = $this->imagen;
        $this->vacante->categoria_id = $this->categoria;
        $this->vacante->salario_id = $this->salario;
        $this->vacante->save(); */

        //! otra forma es encontrar la vacante por su id y luego actualizarla
        /* $vacante = Vacante::find($this->vacante->id);
        $vacante->titulo = $this->titulo;
        $vacante->ultimo_dia = $this->ultimo_dia;
        $vacante->empresa = $this->empresa;
        $vacante->descripcion = $this->descripcion;
        $vacante->imagen = $this->imagen;
        $vacante->categoria_id = $this->categoria;
        $vacante->salario_id = $this->salario;
        $vacante->save(); */
    }
}
