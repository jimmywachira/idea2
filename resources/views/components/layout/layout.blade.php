<!doctype html>
<html lang="en" data-theme="coffee">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'Idea' }}</title>
    <meta name="description" content="A professional developer blog">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Google+Sans+Code&display=swap" rel="stylesheet"> 

    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- @livewireStyles --}}
</head>

<body class="antialiased font-semibold capitalize text-2xl bg-base-200" style="font-family: 'Google Sans Code', sans-serif;">

    <x-layout.navbar />

    <main class="max-w-7xl mx-auto p-6 ">
        {{ $slot }}
    </main>

    @if (session('success'))
        <div
            x-data="{ show: true }"
            x-init="setTimeout(() => show = false, 3000)"
            x-show="show"
            x-transition.opacity.duration.300ms
            class="fixed bottom-4 right-4 bg-base-400 px-4 py-3 rounded shadow-lg"
            style="display: none;"
        >
            {{ session('success') }}
        </div>
    @endif
    
    <x-footer />

    <!-- Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    
    {{-- @livewireScripts --}}
</body>
</html>
