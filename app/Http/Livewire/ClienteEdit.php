<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Cliente;

class ClienteEdit extends Component{

  public $cliente;
  public $open=false;

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

  public function mount(Cliente $cliente){
    $this->cliente = $cliente;
  }

  public function render(){
      $cliente=$this->cliente;
      return view('livewire.cliente-edit',compact('cliente'));
  }

  public function store(){
    $this->validate();
    $this->cliente->save();
    $this->reset(['open']);
    $this->emitTo('clientelivewire','render');
    $this->emit('alert','Registro actualizado satisfactoriamente');
  }
}
