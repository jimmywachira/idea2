@props(['name' => 'modal', 'title' => 'Modal Title'])

<div 
    x-data="{ show: false, name: @js($name),newStep: '', steps: [] }"
    x-show="show"
    @open-modal.window="if ($event.detail?.name === name) show = true"
    @close-modal.window="show = false"
    @keydown.escape.window="show = false"
    @click.self="show = false"
    class="fixed inset-0 z-50 flex items-center justify-center backdrop-blur-sm"
 
    role="dialog"
    aria-hidden="true"
    aria-labelledby="modal-title-{{ $name }}"
    tabindex="-1"
    :aria-hidden="!show"
    aria-modal="true"

    x-transition:enter="duration-200 ease-out"
    x-transition:enter-start="opacity-0 translate-y-4"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="duration-150 ease-in"
    x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 translate-y-2"
    >
     
    <x-card class="w-full max-w-lg relative" @click.stop type="button">
      <div class="flex items-center justify-between mb-4">
        <button @click="show = false" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>

      <div> {{$slot}} </div>
    </x-card>
</div>