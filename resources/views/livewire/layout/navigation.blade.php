<nav class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Menú Principal -->
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <!-- Links -->
                <div class="hidden sm:flex sm:space-x-4">
                    @foreach ($menu as $item)
                        @if (!isset($item['submenu']))
                            <a href="{{ route($item['route']) }}"
                               class="flex items-center space-x-2 px-4 py-2 text-sm font-medium 
                                      {{ $item['active'] ? 'bg-gray-200 text-gray-800' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-800' }}
                                      dark:{{ $item['active'] ? 'bg-gray-700 text-white' : 'text-gray-400 hover:bg-gray-600 hover:text-gray-200' }}">
                                <x-dynamic-component :component="$item['icon']" class="w-5 h-5" />
                                <span>{{ $item['label'] }}</span>
                            </a>
                        @else
                            <!-- Dropdown -->
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open" 
                                        class="flex items-center space-x-2 px-4 py-2 text-sm font-medium text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <x-dynamic-component :component="$item['icon']" class="w-5 h-5" />
                                    <span>{{ $item['label'] }}</span>
                                    <svg class="w-4 h-4 transform" :class="{ 'rotate-180': open }" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 9.293a1 1 0 011.414 0L10 12.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>

                                <div x-show="open" @click.outside="open = false" 
                                     class="absolute z-10 mt-2 w-48 rounded-md shadow-lg bg-white dark:bg-gray-800">
                                    <div class="py-2">
                                        @foreach ($item['submenu'] as $submenu)
                                            <a href="{{ route($submenu['route']) }}"
                                               class="block px-4 py-2 text-sm font-medium 
                                                      {{ $submenu['active'] ? 'bg-gray-200 text-gray-800' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-800' }}
                                                      dark:{{ $submenu['active'] ? 'bg-gray-700 text-white' : 'text-gray-400 hover:bg-gray-600 hover:text-gray-200' }}">
                                                {{ $submenu['label'] }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

            <!-- Logout -->
            <div class="hidden sm:flex sm:items-center">
                <form >
                    @csrf
                    <button type="submit" class="text-sm font-medium text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
