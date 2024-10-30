<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Productos;
use App\Models\CategoriaProds;
use Livewire\WithFileUploads;

class Producto extends Component{
    public $producto_id,$categoria_prods_id,$nombre,$precio,$imagen,$disponibilidad;
    public $isOpen = 0;
    public $search;
    public $sort='id';
    public $direction='asc';

    use WithFileUploads;

    public function render(){
        //$productos=Productos::all();
        $productos=Productos::where('nombre','like','%'.$this->search.'%')
        ->orderBy($this->sort,$this->direction)
        ->get();
        $categorias=CategoriaProds::all();
        return view('livewire.producto',compact("productos","categorias"));
    }

    public function order($sort){
        if ($this->sort==$sort) {
            if ($this->direction=='asc') {
                $this->direction='desc';
            }else{
                $this->direction='asc';
            }
        } else {
            $this->sort=$sort;
            $this->direction="asc";
        }

        //$this->sort=$sort;
        //$this->direction="asc";
    }

    public function create(){
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal(){
        $this->isOpen = true;
    }

    public function closeModal(){
        $this->isOpen = false;
    }

    private function resetInputFields(){
        $this->categoria_prods_id = '';
        $this->nombre = '';
        $this->producto_id = '';
        $this->precio = '';
        $this->imagen = '';
        $this->disponibilidad = '';
    }

    public function store(){
        $dataValid =$this->validate([
            'nombre' => 'required',
            'precio' => 'required',
            'disponibilidad' => 'required',
            'imagen' => 'required|image|mimes:jpg,jpeg,png,svg,gif|max:2048',
        ]);
        $dataValid['imagen'] = $this->imagen->store('tienda', 'public');

        Productos::updateOrCreate(['id' => $this->producto_id], [
            'categoria_prods_id' => $this->categoria_prods_id,
            'nombre' => $this->nombre,
            'precio' => $this->precio,
            'imagen' => $dataValid['imagen'],
            'disponibilidad' => $this->disponibilidad,
        ]);
        session()->flash('message',
            $this->producto_id ? 'Registro actualizado satisfactoriamente' : 'Registro Creado Satisfactoriamente.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id){

        $post = Productos::findOrFail($id);
        $this->producto_id=$id;
        $this->categoria_prods_id = $post->categoria_prods_id;
        $this->nombre = $post->nombre;
        $this->precio = $post->precio;
        $this->imagen = 'storage/'.$post->imagen;
        $this->disponibilidad = $post->disponibilidad;

        $this->openModal();
    }

    public function delete($id){
        Productos::find($id)->delete();
        session()->flash('message', 'Registro Deleted Successfully.');
    }
}
