<div
    class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
    <div class="flex justify-end m-2 p-2">
        <x-button wire:click="showEdModal">Añadir</x-button>
    </div>
    <div class="m-2 p-2">
        <!--Tabla-->
        <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700">
            <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm dark:divide-gray-700 dark:bg-gray-900">
                <thead class="ltr:text-left rtl:text-right">
                    <tr>
                        <th class="whitespace-nowrap px-4 py-3 font-medium text-gray-900 dark:text-white">
                            ID
                        </th>
                        <th class="whitespace-nowrap px-4 py-3 font-medium text-gray-900 dark:text-white">
                            Nombre
                        </th>
                        <th class="whitespace-nowrap px-4 py-3 font-medium text-gray-900 dark:text-white">
                            Logo
                        </th>
                        <th class="whitespace-nowrap px-4 py-3 font-medium text-gray-900 dark:text-white">
                            Acciones
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach ($editorials as $editorial)
                        <tr class="odd:bg-gray-50 dark:odd:bg-gray-800/50 mx-auto px-auto">

                            <td class="whitespace-nowrap px-4 py-3 font-medium text-gray-900 dark:text-white">
                                {{ $editorial->id }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-3 text-gray-700 dark:text-gray-200">
                                {{ $editorial->name }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-3 text-gray-700 dark:text-gray-200">
                                <img class="w-8 h-8 rounded-sm" src="{{ Storage::url($editorial->image) }}" />
                            </td>
                            <td class="whitespace-nowrap px-4 py-3 text-gray-700 dark:text-gray-200">
                                <!--Acciones-->
                                <div
                                    class="inline-flex rounded-lg border border-gray-100 bg-gray-100 p-1 dark:border-gray-800 dark:bg-gray-900">
                                    <button wire:click='showEditEdModal({{ $editorial->id }})'
                                        class="inline-flex items-center gap-2 rounded-md px-4 py-2 text-sm text-gray-500 hover:text-gray-700 focus:relative dark:text-gray-400 dark:hover:text-gray-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>

                                        Editar
                                    </button>

                                    <button wire:click='deleteEd({{ $editorial->id }})'
                                        class="inline-flex items-center gap-2 rounded-md bg-white px-4 py-2 text-sm text-red-500 hover:text-red-400 shadow-sm focus:relative dark:bg-gray-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                        Eliminar
                                    </button>
                                </div>
                                <!--Acciones-->
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!--Tabla-->
    </div>
    <div>
        <!--Modal-->
        <x-dialog-modal wire:model="showingEdModal">
            @if ($isEditMode)
                <x-slot name="title">Actualizar Editorial</x-slot>
            @else
                <x-slot name="title">Agregar Editorial</x-slot>
            @endif

            <x-slot name="content">
                <div class="space-y-8 divide-y divide-gray-200 w-full mt-10">
                    <form enctype="multipart/form-data">
                        <div class="sm:col-span-6 py-2">
                            <label for="title" class="block text-sm font-medium text-white">
                                Nombre de la Editorial
                            </label>
                            <div class="mt-1">
                                <x-input type="text" id="name" wire:model.lazy="name" name="name"
                                    class="w-full"></x-input>
                                <!--input type="text" id="name" wire:model.lazy="name" name="name"
                                    class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" /-->
                            </div>
                            @error('name')
                                <span class="text-red-400">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="sm:col-span-6 py-2">
                            <label for="title" class="block text-sm font-medium text-white"> Agregar Imagen
                            </label>
                            @if ($oldImage)
                                Previsualizacion:
                                <img class="mx-auto px-auto w-3/4 my-1" src="{{ Storage::url($oldImage) }}">
                            @endif
                            @if ($newImage)
                                Previsualizacion:
                                <img class="mx-auto px-auto w-3/4 my-1" src="{{ $newImage->temporaryUrl() }}">
                            @endif
                            <div class="mt-1 py-2">
                                <input type="file" id="image" wire:model="newImage" name="image"
                                    class="block w-full appearance-none dark:bg-gray-900 border border-gray-300 dark:border-gray-700 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600  rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                            </div>
                            @error('newImage')
                                <span class="text-red-400">{{ $message }}</span>
                            @enderror
                        </div>
                    </form>
                </div>

            </x-slot>

            <x-slot name="footer">
                @if ($isEditMode)
                    <x-button wire:click='updateEd'>Actualizar</x-button>
                @else
                    <x-button wire:click='storeEd'>Añadir</x-button>
                @endif
            </x-slot>
        </x-dialog-modal>
        <!--Modal-->
    </div>
</div>
