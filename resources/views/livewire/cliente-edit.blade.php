<div>
    <x-jet-button wire:click="$set('open',true)"> <!-- Usamos metodos magicos -->
        <i class="fas fa-edit"></i>
    </x-jet-button>

    <x-jet-dialog-modal wire:model="open">
      <x-slot name="title">
        <h3>Editar cliente {{$cliente->id}}</h3>
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
        <x-jet-button wire:click="store" wire:loading.attr="disabled" wire:target="store" class="disabled:opacity-25">
          Actualizar
        </x-jet-button>
        <!-- <span wire:loading wire:target="store">Cargando...</span> -->
      </x-slot>
    </x-jet-dialog-modal>
  </div>

</div>
