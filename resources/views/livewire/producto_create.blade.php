<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
  <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

    <div class="fixed inset-0 transition-opacity">
      <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
    </div>

    <!-- This element is to trick the browser into centering the modal contents. -->
    <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​

    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
      <form wire:submit.prevent="store" enctype="multipart/form-data">
      @csrf
      <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        <div class="">
              <div class="mb-4">
                  <label class="block text-gray-700 text-sm font-bold mb-2">Categoria Producto:</label>
                  <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" wire:model="categoria_prods_id">
                    <option value="" selected>--Seleccione--</option>
                    @foreach ($categorias as $cat)
                      <option value="{{$cat->id}}">{{$cat->nombre}}</option>
                    @endforeach
                  </select>
                  @error('categoria_prods_id') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>
              <div class="mb-4">
                  <label class="block text-gray-700 text-sm font-bold mb-2">Nombre Producto:</label>
                  <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Nombre" wire:model="nombre">
                  @error('nombre') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>
              <div class="mb-4">
                  <label class="block text-gray-700 text-sm font-bold mb-2">Precio Producto:</label>
                  <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Precio" wire:model="precio">
                  @error('precio') <span class="text-red-500">{{ $message }}</span>@enderror
              </div>
              <div class="mb-4">
                  <label class="block text-gray-700 text-sm font-bold mb-2">Imagen:</label>
                  <input type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" wire:model="imagen">
                  @error('imagen') <span class="text-red-500">{{ $message }}</span>@enderror
                  <div wire:loading wire:target="imagen" class="bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3" role="alert">
                    <p class="font-bold">!Imagen cargando!</p>
                    <p class="text-sm">Espere hasta que la imagen termine de procesar</p>
                  </div>
                  @if($imagen)
                    @if($producto_id==null)
                      <img src="{{$imagen->temporaryUrl()}}">
                    @else
                      <img src="{{$imagen}}">
                    @endif

                  @endif
              </div>
              <div class="mb-4">
                  <label class="md:w-2/3 block text-gray-500 font-bold">
                  <input type="checkbox" class="mr-2 leading-tight" wire:model="disponibilidad">
                  <span class="text-sm">
                    Producto disponible?
                  </span>
                  @error('precio') <span class="text-red-500">{{ $message }}</span>@enderror
                  </label>
              </div>
        </div>
      </div>

      <div class="bg-gray-50 px-4 py-3 sm:px-6">
        <x-jet-secondary-button wire:click="closeModal()">Cancelar</x-jet-secondary-button>
        <x-jet-danger-button wire:click.prevent="store()" wire:loading.attr="disabled" wire:target="save,imgen" class="disabled:opacity-25">Guardar</x-jet-danger-button>
      </div>
      </form>
    </div>
  </div>
</div>
