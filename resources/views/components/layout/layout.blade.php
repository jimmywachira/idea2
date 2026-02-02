<!doctype html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'Idea' }}</title>
    <meta name="description" content="{{ $description ?? 'A professional developer blog' }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Google+Sans+Code&display=swap" rel="stylesheet"> 

    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- @livewireStyles --}}
</head>

<body class="antialiased font-semibold capitalize text-2xl bg-base-200 relative" style="font-family: 'Google Sans Code', sans-serif;">
    <!-- Grid Background Pattern -->
    <div class="absolute inset-0 -z-10 h-full w-full bg-white bg-[linear-gradient(to_right,#8080800a_1px,transparent_1px),linear-gradient(to_bottom,#8080800a_1px,transparent_1px)] bg-[size:14px_24px]"></div>

    <x-layout.navbar />

    <main class="max-w-7xl mx-auto p-6 ">
        {{ $slot }}
    </main>

    <!-- Professional Toast Notifications -->
    @if (session('success'))
        <div
            x-data="{ show: true }"
            x-init="setTimeout(() => show = false, 4000)"
            x-show="show"
            x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="translate-x-full opacity-0"
            x-transition:enter-end="translate-x-0 opacity-100"
            x-transition:leave="transition ease-in duration-200 transform"
            x-transition:leave-start="translate-x-0 opacity-100"
            x-transition:leave-end="translate-x-full opacity-0"
            class="fixed top-4 right-4 z-50 max-w-sm w-full bg-white rounded-xl shadow-2xl border-l-4 border-success overflow-hidden"
            style="display: none;"
        >
            <div class="p-4 flex items-start gap-3">
                <!-- Success Icon -->
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 rounded-full bg-success/10 flex items-center justify-center">
                        <ion-icon name="checkmark-circle" class="text-2xl text-success"></ion-icon>
                    </div>
                </div>
                
                <!-- Message Content -->
                <div class="flex-1 pt-1">
                    <h4 class="font-bold text-sm text-base-content mb-0.5">Success</h4>
                    <p class="">{{ session('success') }}</p>
                </div>
                
                <!-- Close Button -->
                <button 
                    @click="show = false"
                    class="flex-shrink-0 text-base-content/40 hover:text-base-content/70 transition-colors"
                >
                    <ion-icon name="close" class="text-xl"></ion-icon>
                </button>
            </div>
            
            <!-- Progress Bar -->
            <div class="h-1 bg-success/20">
                <div 
                    class="h-full bg-success"
                    x-data="{ width: '100%' }"
                    x-init="setTimeout(() => width = '0%', 100)"
                    :style="`width: ${width}; transition: width 4000ms linear;`"
                ></div>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div
            x-data="{ show: true }"
            x-init="setTimeout(() => show = false, 4000)"
            x-show="show"
            x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="translate-x-full opacity-0"
            x-transition:enter-end="translate-x-0 opacity-100"
            x-transition:leave="transition ease-in duration-200 transform"
            x-transition:leave-start="translate-x-0 opacity-100"
            x-transition:leave-end="translate-x-full opacity-0"
            class="fixed top-4 right-4 z-50 max-w-sm w-full bg-white rounded-xl shadow-2xl border-l-4 border-error overflow-hidden"
            style="display: none;"
        >
            <div class="p-4 flex items-start gap-3">
                <!-- Error Icon -->
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 rounded-full bg-error/10 flex items-center justify-center">
                        <ion-icon name="close-circle" class="text-2xl text-error"></ion-icon>
                    </div>
                </div>
                
                <!-- Message Content -->
                <div class="flex-1 pt-1">
                    <h4 class="font-bold text-sm text-base-content mb-0.5">Error</h4>
                    <p class="text-xs text-base-content/70 normal-case font-normal">{{ session('error') }}</p>
                </div>
                
                <!-- Close Button -->
                <button 
                    @click="show = false"
                    class="flex-shrink-0 text-base-content/40 hover:text-base-content/70 transition-colors"
                >
                    <ion-icon name="close" class="text-xl"></ion-icon>
                </button>
            </div>
            
            <!-- Progress Bar -->
            <div class="h-1 bg-error/20">
                <div 
                    class="h-full bg-error"
                    x-data="{ width: '100%' }"
                    x-init="setTimeout(() => width = '0%', 100)"
                    :style="`width: ${width}; transition: width 4000ms linear;`"
                ></div>
            </div>
        </div>
    @endif

    @if (session('warning'))
        <div
            x-data="{ show: true }"
            x-init="setTimeout(() => show = false, 4000)"
            x-show="show"
            x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="translate-x-full opacity-0"
            x-transition:enter-end="translate-x-0 opacity-100"
            x-transition:leave="transition ease-in duration-200 transform"
            x-transition:leave-start="translate-x-0 opacity-100"
            x-transition:leave-end="translate-x-full opacity-0"
            class="fixed top-4 right-4 z-50 max-w-sm w-full bg-white rounded-xl shadow-2xl border-l-4 border-warning overflow-hidden"
            style="display: none;"
        >
            <div class="p-4 flex items-start gap-3">
                <!-- Warning Icon -->
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 rounded-full bg-warning/10 flex items-center justify-center">
                        <ion-icon name="warning" class="text-2xl text-warning"></ion-icon>
                    </div>
                </div>
                
                <!-- Message Content -->
                <div class="flex-1 pt-1">
                    <h4 class="font-bold text-sm text-base-content mb-0.5">Warning</h4>
                    <p class="text-xs text-base-content/70 normal-case font-normal">{{ session('warning') }}</p>
                </div>
                
                <!-- Close Button -->
                <button 
                    @click="show = false"
                    class="flex-shrink-0 text-base-content/40 hover:text-base-content/70 transition-colors"
                >
                    <ion-icon name="close" class="text-xl"></ion-icon>
                </button>
            </div>
            
            <!-- Progress Bar -->
            <div class="h-1 bg-warning/20">
                <div 
                    class="h-full bg-warning"
                    x-data="{ width: '100%' }"
                    x-init="setTimeout(() => width = '0%', 100)"
                    :style="`width: ${width}; transition: width 4000ms linear;`"
                ></div>
            </div>
        </div>
    @endif
    
    <x-footer />

    <!-- Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    
    {{-- @livewireScripts --}}
</body>
</html>
