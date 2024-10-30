<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if (session()->has('message'))
                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3"
                role="alert">
                  <div class="flex">
                    <div>
                      <p class="text-sm">{{ session('message') }}</p>
                    </div>
                  </div>
                </div>
            @endif
            <button wire:click="create()"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">
            Registrar Producto</button>
            @if($isOpen)
                @include('livewire.producto_create')
            @endif

            <div class="mb-1">
               <!-- <input type="text" wire:model="search"> -->
               Buscar: <x-jet-input type="text" wire:model="search"/>
            </div>
            @if($productos->count())
            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="cursor-pointer px-4 py-2 w-20" wire:click="order('id')">No. <i class="fas fa-sort"></i></th>
                        <th class="cursor-pointer px-4 py-2" wire:click="order('nombre')">Nombre
                            @if($sort=='nombre')
                                @if($direction=='asc')
                                    <i class="fas fa-sort-alpha-up"></i>
                                @else
                                    <i class="fas fa-sort-alpha-down-alt"></i>
                                @endif
                            @else
                                <i class="fas fa-sort"></i>
                            @endif
                        </th>
                        <th class="cursor-pointer px-4 py-2" wire:click="order('precio')">Precio <i class="fas fa-sort"></i></th>
                        <th class="px-4 py-2">Imagen</th>
                        <th class="cursor-pointer px-4 py-2">Disponibilidad</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productos as $prod)
                    <tr>
                        <td class="border px-4 py-2">{{ $prod->id }}</td>
                        <td class="border px-4 py-2">{{ $prod->nombre }}</td>
                        <td class="border px-4 py-2">{{ $prod->precio }}</td>
                        <td class="border px-4 py-2"><img src="/storage/{{ $prod->imagen }}"></td>
                        <td class="border px-4 py-2">{{ $prod->disponibilidad?'SI':'NO' }}</td>
                        <td class="border px-4 py-2">

                        <button wire:click="edit({{ $prod->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"><i class="fas fa-pen"></i></button>

                        <button wire:click="delete({{ $prod->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"><i class="fas fa-trash-alt"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <div class="py-4">
                    <span><b>No se encontró ningun registro</b></span>
                </div>
            @endif
        </div>
    </div>
</div>
