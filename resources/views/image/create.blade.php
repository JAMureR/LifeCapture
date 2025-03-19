<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Subir Imagen') }}
        </h2>
    </x-slot>

    <div class="flex items-center justify-center mt-10 ">
        <!-- Recuadro alrededor del formulario -->
        <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-300 w-full max-w-md">
            <form class="mt-6 space-y-6" method="POST" action="{{ route('image.save') }}" enctype="multipart/form-data">
                @csrf
                <!-- Campo para subir imagen -->
                <div>
                    <x-input-label for="image_path" :value="__('Imagen')" />
                    <input type="file" name="image_path" id="imagen" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" required />
                    @error('image_path')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <x-input-label for="description" :value="__('Descripción')" />
                    <textarea name="description" id="description" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" required ></textarea>
                    @error('description')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex justify-center">
                    <x-primary-button  type="submit">{{ __('Subir Imagen') }}</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>