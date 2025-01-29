@props(['message'])
<div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded-lg relative transition-all duration-300 ease-in-out transform hover:scale-105" role="alert">
    <div class="flex items-center">
        <!-- Icono de error -->
        <x-heroicon-s-x-circle class="h-6 w-6 text-red-500 mr-3" />
        <span class="font-semibold text-sm">{{ $message }}</span>
    </div>
    <!-- Botón de cierre -->
    {{-- <button type="button" class="absolute top-0 right-0 p-2 text-red-500 hover:text-red-700" x-on:click="this.parentElement.remove()">
        <x-heroicon-o-x-mark class="h-5 w-5" />
    </button> --}}
</div>
