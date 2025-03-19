@if(session('message'))
    <div class="bg-green-500 text-white font-semibold p-3 rounded-md shadow-md">
        {{ session('message') }}
    </div>
@endif