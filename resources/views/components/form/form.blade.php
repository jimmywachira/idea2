@props(['title', 'description'])

<div class="flex flex-col h-full w-full items-center justify-center px-4">
    <div class="w-full max-w-2xl text-center">   
        <div>
            <h1 class="text-3xl mt-4 font-bold mb-4">{{ $title }}</h1>
            <p class="mb-4">{{$description }}</p>
        </div>

        {{ $slot }}

    </div>  
</div>