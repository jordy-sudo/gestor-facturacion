<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Menú Principal -->
                <div class="hidden sm:flex sm:justify-center space-x-8 sm:space-x-6 sm:-my-px sm:ml-10">
                    @foreach ($menuItems as $item)
                        @can($item->permission)
                            <div class="relative" x-data="{ submenuOpen: false }">
                                <!-- Enlace principal -->
                                <x-nav-link :href="$item->children->isEmpty() ? route($item->route) : null" :active="request()->routeIs($item->route)" class="flex items-center cursor-pointer"
                                    @click="submenuOpen = !submenuOpen" wire:navigate>
                                    {{ __($item->title) }}
                                    @if ($item->children->isNotEmpty())
                                        <svg class="ml-1 w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    @endif
                                </x-nav-link>

                                <!-- Submenú -->
                                @if ($item->children->isNotEmpty())
                                    <div x-show="submenuOpen" @click.away="submenuOpen = false" x-transition
                                        class="absolute z-10 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg">
                                        @foreach ($item->children as $submenu)
                                            <a href="{{ route($submenu->route) }}"
                                                class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                                wire:navigate>
                                                <!-- Ícono -->
                                                @svg($submenu->icon, 'w-6 h-6 mr-2 text-gray-500')

                                                <!-- Texto -->
                                                {{ __($submenu->title) }}
                                            </a>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @endcan
                    @endforeach
                </div>
            </div>

            <!-- Dropdown de Usuario -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border text-sm rounded-md text-gray-500 bg-white hover:text-gray-700">
                            <div>{{ Auth::user()->name }}</div>
                            <svg class="ml-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 011.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile')" wire:navigate>
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <form>
                            @csrf
                            <x-dropdown-link wire:click="logout">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = !open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" stroke-linecap="round"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" stroke-linecap="round"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Menú Responsivo -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @foreach ($menuItems as $item)
                @can($item->permission)
                    <x-responsive-nav-link :href="route($item->route)" :active="request()->routeIs($item->route)">
                        {{ __($item->title) }}
                    </x-responsive-nav-link>
                @endcan
            @endforeach
        </div>
    </div>
</nav>
