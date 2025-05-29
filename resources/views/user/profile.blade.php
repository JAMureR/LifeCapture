<x-app-layout>
    <x-slot name="header">
        @include('includes.message')
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Perfil') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="p-6 text-gray-900 dark:text-gray-100">
            <div class="grid grid-cols-1 gap-6 text-black">

                <div id="profile-user" class="col-span-full " >

                    @if($user->image)
                    <div id="container-avatar" >
                        <img src="{{ route('user.avatar', ['filename' => $user->image]) }}" class="w-24 h-24 rounded-full object-cover"/>
                    </div>
                    @endif

                    <div id="user-info">
                        <h1 class="text-3xl font-bold text-gray-800">{{'@'. $user->nick }}</h1>
                        <h2 class="whitespace-nowrap text-xl text-gray-700">{{ $user->name . ' ' . $user->surname }}</h2>
                        
                        
                    </div>
                </div>
                <div class="clearfix"></div>

                <hr class=" col-span-full w-full border-t-2 border-gray-300 my-4">
                
               

                @foreach ($user->images as $image)
                   @if(!empty($image->image_path) && Storage::disk('images')->exists($image->image_path))
                        <div class="relative bg-gray-900 rounded-lg shadow-md overflow-hidden w-full max-w-3xl mx-auto">
                            <!-- Imagen de fondo -->
                            <a href="{{ route('image.detail',['id'=> $image->id]) }}">
                                <img class="w-full h-full object-cover" src="{{ route('image.file',['filename' => $image->image_path]) }}" alt="Imagen subida" />
                            </a>

                            <!-- Info usuario -->
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

                                <!-- Descripción -->
                                <div class="description mt-2">
                                    {{ $image->description }}
                                    <p id="date-created">{{ $image->created_at }}</p>
                                </div>

                                <!-- Comentarios y likes -->
                                <div class="flex justify-between items-center w-full mt-4">
                                    <a id="btn-comments" href="{{ route('image.detail', ['id' => $image->id]) }}"  class="inline-flex items-center bg-gray-400 hover:bg-yellow-500 text-white text-sm font-semibold py-2 px-4 rounded-lg shadow-md">
                                        Comentarios&nbsp;({{ count($image->comments) }})
                                    </a>

                                    <!-- Icono de corazón al lado derecho -->
                                    <div id="likes" class="flex items-center">
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
                                        <img src="{{ asset('img/heart-red.png') }}" data-id="{{ $image->id }}" class="btn-dislike w-8 h-8 ml-4" />
                                        @else
                                        <!-- Imagen para el "like" (corazón gris) -->
                                        <img src="{{ asset('img/heart-gray.png') }}" data-id="{{ $image->id }}" class="btn-like w-7 h-7 ml-4" />
                                        @endif

                                        <!-- Mostrar la cantidad de likes -->                        
                                        <div id="like-count" class="ml-2 relative top-1.5">
                                            <span class="number_likes">{{ count($image->likes) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>