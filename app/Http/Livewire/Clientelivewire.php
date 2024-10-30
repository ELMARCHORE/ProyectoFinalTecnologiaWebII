<?php
namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Cliente;

use Livewire\WithPagination; //para hacer la paginacion dinamica, no se recargue toda la pagina

class Clientelivewire extends Component{
    public $search;
    public $isOpen=false; //para modal
    public $correo,$celular,$nombre,$apellidos,$tdocumento,$documento,$direccion,$tdatos;
    //protected $listeners=['render'=>'render','delete']; //para escuchar los toEmits de las vistas
    protected $listeners=['render','delete'];//porque el nombre de emit y el vento es el mismo
    public $open_edit=false; //modal editar
    public $cliente;

    use WithPagination;

    protected $rules=[
      'cliente.correo'=>'required|email',
      'cliente.celular'=>'required|max:100',
      'cliente.nombre'=>'required|max:30',
      'cliente.apellidos'=>'required|max:30',
      'cliente.tdocumento'=>'required',
      'cliente.documento'=>'required|max:8',
      'cliente.direccion'=>'required|max:100',
      'cliente.tdatos'=>'required'
    ];

    public function updated($propertyName){ //validaciones dinamicas
      $this->validateOnly($propertyName);
    }

    public function mount(){
        $this->cliente=new Cliente();
    }

    //Metodos del ciclo de vida de liveire https://laravel-livewire.com/docs/2.x/lifecycle-hooks
    //updating + nombre de propiedad
    public function updatingSearch(){ //para corregir el funcionamento del buscador
      $this->resetPage();
    }

    public function updatingisOpen(){
      if(!$this->isOpen){
        $this->reset(['cliente']);
      }

    }

    public function render(){
      //$clientes=Cliente::all();
      $clientes=Cliente::where('nombre','like','%'.$this->search.'%')
      ->orWhere('apellidos','like','%'.$this->search.'%')
      // ->orderBy($this->sort,$this->direction)
      ->orderBy('id','desc')
      //->get();
      ->paginate(10);

      return view('livewire.clientelivewire',compact('clientes'));
    }

    public function store(Request $request){
      $this->validate();
      /*
      Cliente::create([
        'correo'=>$this->cliente->correo,
        'celular'=>$this->cliente->celular,
        'nombre'=>$this->cliente->nombre,
        'apellidos'=>$this->cliente->apellidos,
        'tdocumento'=>$this->cliente->tdocumento,
        'documento'=>$this->cliente->documento,
        'direccion'=>$this->cliente->direccion,
        'tdatos'=>$this->cliente->tdatos,
      ]);
      */
      Cliente::create($this->cliente);
      $this->reset(['isOpen','cliente']);
      $this->emitTo('clientelivewire','render');
      $this->emit('alert','Registro creado satisfactoriamente');
    }

    public function edit(Cliente $cliente){
      $this->cliente=$cliente;
      $this->open_edit=true;
    }

    public function update(){
      $this->validate();
      $this->cliente->save();
      $this->reset(['open_edit','cliente']);
      $this->emitTo('clientelivewire','render');
      $this->emit('alert','Registro actualizado satisfactoriamente');
    }

    public function delete(Cliente $cliente){
      $cliente->delete();
    }

}
