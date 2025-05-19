@php
    // Compatibilidad: si viene desde likes y no se ha pasado directamente $image
    if (!isset($image) && isset($like)) {
        $image = $like->image;
    }
@endphp


                    @if(!empty($image->image_path) && Storage::disk('images')->exists($image->image_path))
                        <div class="relative bg-gray-900 rounded-lg shadow-md overflow-hidden">
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
                                    <a id="btn-comments" href="{{ route('image.detail', ['id' => $image->id]) }}" class="bg-yellow-400 hover:bg-yellow-500 text-white font-semibold py-2 px-4 rounded-lg shadow-md">
                                        Comentarios ({{ count($image->comments) }})
                                    </a>

                                    <div id="likes">
                                        @php
                                            $user_like = $image->likes->contains('user_id', Auth::id());
                                        @endphp

                                        @if($user_like)
                                            <img src="{{ asset('img/heart-red.png') }}" data-id="{{ $image->id }}" class="btn-dislike w-6 h-6 ml-4" />
                                        @else
                                            <img src="{{ asset('img/heart-gray.png') }}" data-id="{{ $image->id }}" class="btn-like w-6 h-6 ml-4" />
                                        @endif

                                        <span class="number_likes">{{ count($image->likes) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif