<x-app-layout>
    <x-slot name="header">
        @include('includes.message')
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Publicaciones a las que has dado like') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="p-6 text-gray-900 dark:text-gray-100">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 text-black">
                @foreach ($likes as $like)
                    @include('includes.image', ['image' => $like->image])
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
