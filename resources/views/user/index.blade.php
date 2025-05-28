<x-app-layout>
    <x-slot name="header">
        @include('includes.message')
        <div class="flex items-center gap-4">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Personas') }}
            </h2>
            <form method="GET" action="{{ route('user.index') }}" class="flex items-center gap-2">
                <input type="text" id="search" name="search" class="border rounded px-2 py-1 text-sm"   >
                <input type="submit" value="Buscar" class="text-sm underline cursor-pointer"></input>
            </form>
        </div>
    </x-slot>


    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 text-black">

                        @foreach($users as $user)
                            <div id="profile-user" class= "gap-4 col-span-full border-b  pb-6">

                                @if($user->image)
                                    <div id="container-avatar">
                                        <img src="{{ route('user.avatar', ['filename' => $user->image]) }}" class="w-24 h-24 rounded-full object-cover" />
                                    </div>
                                @endif

                                <div id="user-info">
                                    
                                        <h2 class="text-xl font-bold text-gray-800">{{ '@' . $user->nick }}</h2>                           
                                        <h3 class="whitespace-nowrap text-xl text-gray-700">
                                        {{ $user->name . ' ' . $user->surname }}</h3>
                                        <a href="{{ route('profile', ['id' => $user->id]) }}" class="underline text-xs">Ver perfil</a>
                                </div>
                                
                                
                                
                            </div>
                        @endforeach
                    </div>

                    <!--Paginacion -->
                    <div class="mt-6">
                        {{ $users->links('pagination::tailwind') }}
                    </div>



                </div>
            </div>
        </div>


</x-app-layout>