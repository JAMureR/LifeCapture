<x-app-layout>
    <x-slot name="header">
        @include('includes.message')
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 text-black">
                        @foreach($images as $image)
                        @if(!empty($image->image_path) && Storage::disk('images')->exists($image->image_path))
                        <div class="relative bg-gray-900 rounded-lg shadow-md overflow-hidden">

                            <!-- Imagen de fondo ocupando toda la tarjeta -->
                            <a href="{{ route('image.detail',['id'=> $image->id]) }}">
                                <img class="w-full h-full object-cover" src="{{ route('image.file',['filename' => $image->image_path]) }}" alt="Imagen subida" />
                            </a>
                            <!-- Capa de superposición para el nick y el avatar -->
                            <div class="absolute bottom-0 left-0 w-full bg-white bg-opacity-50 p-4 flex flex-col items-start">
                                <div class="flex items-center">
                                    @if($image->user->image)

                                    <img id="user-avatar" src="{{ route('user.avatar', ['filename' => $image->user->image]) }}" />

                                    @endif

                                    <a href="{{ route('profile', ['id' => $image->user->id]) }}">
                                        <p class="font-semibold ml-2">
                                            {{ '@' . $image->user->nick }}
                                        </p>
                                    </a>


                                </div>

                                <!-- Descripción en su propia capa -->
                                <div class="description mt-2">
                                    {{ $image->description }}
                                    <p id="date-created">{{ $image->created_at }}</p>
                                </div>

                                <!-- Contenedor flex para alinear los elementos horizontalmente -->
                                <div class="flex justify-between items-center w-full mt-4">
                                    <!-- Botón de comentarios -->
                                    <a id="btn-comments" href="{{ route('image.detail',['id'=> $image->id]) }}" class="bg-yellow-400 hover:bg-yellow-500 text-white font-semibold py-2 px-4 rounded-lg shadow-md">
                                        Comentarios ({{ count($image->comments) }})
                                    </a>

                                    <!-- Icono de corazón al lado derecho -->
                                    <div id="likes">
                                        <!-- Comprobar si el usuario le dio like a la imagen -->
                                        <?php $user_like = false; ?>
                                        @foreach ($image->likes as $like)
                                        @if($like->user->id == Auth::user()->id)
                                        <?php $user_like = true; ?>
                                        @endif
                                        @endforeach

                                        <!-- Mostrar imagen dependiendo de si el usuario ha dado like o no -->
                                        @if($user_like)
                                        <!-- Imagen para el "dislike" (corazón rojo) -->
                                        <img src="{{ asset('img/heart-red.png') }}" data-id="{{ $image->id }}" class="btn-dislike w-6 h-6 ml-4" />
                                        @else
                                        <!-- Imagen para el "like" (corazón gris) -->
                                        <img src="{{ asset('img/heart-gray.png') }}" data-id="{{ $image->id }}" class="btn-like w-6 h-6 ml-4" />
                                        @endif

                                        <!-- Mostrar la cantidad de likes -->
                                        <span class="number_likes">{{ count($image->likes) }}</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                        @endif
                        @endforeach
                    </div>

                    <!--Paginacion -->
                    <div class="mt-6">
                        {{ $images->links('pagination::tailwind') }}
                    </div>



                </div>
            </div>
        </div>


</x-app-layout>