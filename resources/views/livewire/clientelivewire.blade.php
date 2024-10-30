<div class="py-5">
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">

        <div class="flex items-center justify-between">
    			  <div class="flex items-center p-2 rounded-md flex-1">
              <i class="fas fa-search h-5 w-5 text-gray-400"></i>
              <x-jet-input type="text" wire:model="search" class="w-full " placeholder="search..."/>
            </div>

    				<div class="lg:ml-40 ml-10 space-x-8">
    					<!-- <button class="bg-indigo-600 px-4 py-2 rounded-md text-white font-semibold tracking-wide cursor-pointer">Report</button> -->
    					<!-- <button class="bg-indigo-600 px-4 py-2 rounded-md text-white font-semibold tracking-wide cursor-pointer" wire:click="create()">Nuevo cliente</button> -->
              @include('livewire.cliente_create')
    				</div>
    		</div>
        <x-table>
          <table class="w-full divide-y divide-gray-200 table-auto">
            <thead class="bg-blue-500">
              <tr>
                <td scope="col" class="px-6 py-3 text-left text-xs font-bold  uppercase tracking-wider">
                  ID
                </td>
                <td scope="col" class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">
                  Nombres y apellidos
                </td>
                <td scope="col" class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">
                  Contacto
                </td>
                <td scope="col" class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">
                  Documento
                </td>
                <td scope="col" class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">
                  <span class="">Opciones</span>
                </td>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            <?php foreach ($clientes as $item): ?>
              <tr>
                <td class="px-6 py-4">
                  <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-500">
                    {{$item->id}}
                  </span>
                </td>
                <td class="px-6 py-4">
                  <div class="flex items-center">
                    <div class="">
                      <div class="text-sm font-medium text-gray-900">
                        {{$item->nombre.", ".$item->apellidos}}
                      </div>
                      <div class="text-sm text-gray-500">
                        {{$item->correo}}
                      </div>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4">
                  <div class="text-sm text-gray-900">{{$item->direccion}}</div>
                  <div class="text-sm text-gray-500">{{$item->celular}}</div>
                </td>
                <td class="px-6 py-4">
                  <div class="text-sm text-gray-900">{{$item->tdocumento}}</div>
                  <div class="text-sm text-gray-500">{{$item->documento}}</div>
                </td>
                <td class="px-6 py-4">
                  {{-- @livewire('cliente-edit',['cliente'=>$item],key($item->id)) --}}
                  <x-jet-button wire:click="edit({{$item}})"> <!-- Usamos metodos magicos -->
                      <i class="fas fa-edit"></i>
                  </x-jet-button>
                  <x-jet-danger-button wire:click="$emit('deleteCliente',{{$item->id}})"> <!-- Usamos metodos magicos -->
                      <i class="fas fa-trash"></i>
                  </x-jet-danger-button>
                </td>
              </tr>
              <?php endforeach; ?>
              <!-- More people... -->
            </tbody>
          </table>
          @if(!$clientes->count())
            No existe ningun registro conincidente
          @endif
          @if($clientes->hasPages())
            <div class="px-6 py-3">
              {{$clientes->links()}}
            </div>
          @endif
        </x-table>
      </div>
    </div>
    <!-- Modal -->
    <x-jet-dialog-modal wire:model="open_edit">
      <x-slot name="title">
        <h3>Editar cliente</h3>
      </x-slot>
      <x-slot name="content">
        <div class="flex justify-between -mx-3 mb-6">
          <div class="mb-2 md:mr-2 md:mb-0 w-full">
            <x-jet-label value="Nombres" class="font-bold"/>
            <x-jet-input type="text" wire:model="cliente.nombre" class="w-full"/>
            <x-jet-input-error for="cliente.nombre"/>
          </div>
          <div class="ml-6 mx-5 md:ml-2 w-full">
            <x-jet-label value="Apellidos" class="font-bold"/>
            <x-jet-input type="text" wire:model="cliente.apellidos" class="w-full"/>
            <x-jet-input-error for="cliente.apellidos"/>
          </div>
        </div>
        <div class="flex justify-between -mx-3 mb-6">
          <div class="mb-2 md:mr-2 md:mb-0 w-full">
            <x-jet-label value="Email" class="font-bold"/>
            <x-jet-input type="text" wire:model="cliente.correo" class="w-full"/>
            <x-jet-input-error for="cliente.correo"/>
          </div>
          <div class="ml-6 mx-5 md:ml-2 w-full">
            <x-jet-label value="Telefono/Movil" class="font-bold"/>
            <x-jet-input type="text" wire:model="cliente.celular" class="w-full"/>
            <x-jet-input-error for="cliente.celular"/>
          </div>
        </div>
        <div class="flex justify-between -mx-3 mb-6">
          <div class="mb-2 md:mr-2 md:mb-0 w-full">
            <x-jet-label value="Tipo Documento" class="font-bold"/>
            <select wire:model="cliente.tdocumento" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full">
              <option>Seleccione Opción</option>
              <option value="DNI">CI</option>
              <option value="CARNÉ DE EXTRANGERIA">NIT</option>
              <option value="PASAPORTE">PASAPORTE</option>
            </select>
            <x-jet-input-error for="cliente.tdocumento"/>
          </div>
          <div class="ml-6 mx-5 md:ml-2 w-full">
            <x-jet-label value="Documento" class="font-bold"/>
            <x-jet-input type="text" wire:model="cliente.documento" class="w-full"/>
            <x-jet-input-error for="cliente.documento"/>
          </div>
        </div>
        <div class="mb-2">
          <x-jet-label value="Dirección" class="font-bold"/>
          <x-jet-input type="text" wire:model="cliente.direccion" class="w-full"/>
          <x-jet-input-error for="cliente.direccion"/>
        </div>
        <div class="mb-2">
          <x-jet-checkbox wire:model="cliente.tdatos" value="1"/>
          <span class="ml-2 text-sm text-gray-600"> Acepto el tratamiento de datos personales</span>
          <x-jet-input-error for="cliente.tdatos"/>
        </div>
      </x-slot>
      <x-slot name="footer">
        <x-jet-secondary-button wire:click="$set('open_edit',false)">Cancelar</x-jet-secondary-button>
        <!-- <x-jet-button wire:click="store" wire:loading.remove wire:target="store">Registrar</x-jet-button> -->
        <x-jet-button wire:click="update" wire:loading.attr="disabled" wire:target="store" class="disabled:opacity-25">
          Actualizar
        </x-jet-button>
        <!-- <span wire:loading wire:target="store">Cargando...</span> -->
      </x-slot>
    </x-jet-dialog-modal>

    @push('js')
      <script>
        Livewire.on('deleteCliente',clienteid=>{
          Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
              //emitivos evento para elimianr
              Livewire.emitTo('clientelivewire','delete',clienteid);
              Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
              )
            }
            })
        })
      </script>
    @endpush

  </div>
