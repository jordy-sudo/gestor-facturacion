<div class="container mx-auto">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gestión de Roles') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-full sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                @if (session()->has('success'))
                    <x-alert-success :message="session('success')" />
                @endif

                @if (session()->has('error'))
                    <x-alert-success :message="session('error')" />
                @endif
                {{-- Modal Creación de rol --}}
                <div class="px-6 py-2">
                    <x-primary-button x-data=""
                        x-on:click.prevent="$dispatch('open-modal', 'create-role-modal')">{{ __('Nuevo Rol') }}</x-primary-button>

                    <x-modal name="create-role-modal" :show="$errors->isNotEmpty()" focusable>
                        <form wire:submit.prevent="storeRole">
                            <div class="p-4">
                                <h2 class="text-lg font-bold">Crear Nuevo Rol</h2>

                                <!-- Nombre del Rol -->
                                <div class="mt-4">
                                    <x-input-label for="roleName" :value="__('Nombre del Rol')" />
                                    <x-text-input id="roleName" type="text" class="mt-1 block w-full"
                                        wire:model.defer="storeForm.roleName" />
                                    <x-input-error :messages="$errors->get('storeForm.roleName')" class="mt-2" />
                                </div>

                                <!-- Lista de Permisos -->
                                <div class="mt-4">
                                    <h3 class="text-md font-semibold">{{ __('Permisos') }}</h3>
                                    <div class="grid grid-cols-2 gap-6 mt-4">
                                        <div>
                                            <div class="grid grid-cols-1 gap-x-4 gap-y-2">
                                                @foreach ($permissions as $permission)
                                                    <div class="flex items-center">
                                                        <x-checkbox id="permission-{{ $permission->id }}"
                                                            name="permissions[]" value="{{ $permission->id }}"
                                                            wireModel="storeForm.selectedPermissions"
                                                            :checked="in_array(
                                                                $permission->id,
                                                                $selectedPermissions ?? [],
                                                            )" />
                                                        <label for="permission-{{ $permission->id }}"
                                                            class="ml-2 text-sm text-gray-700">
                                                            {{ $permission->name }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <x-input-error :messages="$errors->get('storeForm.selectedPermissions')" class="mt-2" />
                                </div>

                                <!-- Botones -->
                                <div class="mt-6 flex justify-end">
                                    <x-secondary-button x-on:click="$dispatch('close')">
                                        {{ __('Cancelar') }}
                                    </x-secondary-button>
                                    <x-primary-button class="ml-2" wire:target="storeRole"
                                        wire:loading.attr="disabled">
                                        {{ __('Guardar') }}
                                    </x-primary-button>
                                </div>
                            </div>
                        </form>
                    </x-modal>
                </div>
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <x-loading />
                    <!-- Tabla de roles -->
                    <div class="bg-white shadow-md rounded overflow-x-auto">
                        <table class="w-full border border-gray-200 divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                        No</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                        Nombre</th>
                                    <th
                                        class="px-6 py-3 text-right text-xs font-medium text-gray-600 uppercase tracking-wider">
                                        Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($roles as $role)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $role->id }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                            {{ $role->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex justify-end space-x-2">
                                                <!-- Ver permisos -->
                                                <button wire:click="viewRole({{ $role->id }})"
                                                    class="text-blue-500 hover:text-blue-600" wire:target="viewRole">
                                                    <x-heroicon-o-eye class="w-6 h-6 inline" />
                                                </button>

                                                <!-- Editar -->
                                                <button wire:click="editRole({{ $role->id }})"
                                                    class="text-yellow-500 hover:text-yellow-600">
                                                    <x-heroicon-o-pencil class="w-6 h-6 inline" />
                                                </button>

                                                <!-- Eliminar -->
                                                <button wire:click="confirmDeleteRole({{ $role->id }})"
                                                    class="text-red-500 hover:text-red-600">
                                                    <x-heroicon-o-trash class="w-6 h-6 inline" />
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500">
                                            No se encontraron roles.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{-- Modal de detalle --}}
        <x-modal name="view-role-modal" :show="$errors->isNotEmpty()" focusable>
            <div class="p-4">
                <h2 class="text-lg font-bold">{{ __('Detalles del Rol') }}</h2>

                @if ($selectedRole)
                    <!-- Nombre del Rol -->
                    <div class="mt-4">
                        <x-input-label for="roleName" :value="__('Nombre del Rol')" />
                        <x-text-input id="roleName" type="text" class="mt-1 block w-full"
                            value="{{ $selectedRole->name }}" disabled />
                    </div>

                    <!-- Lista de Permisos -->
                    <div class="mt-4">
                        <h3 class="text-md font-semibold">{{ __('Permisos') }}</h3>
                        <div class="grid grid-cols-2 gap-6 mt-4">
                            <div>
                                <div class="grid grid-cols-1 gap-x-4 gap-y-2">
                                    @foreach ($selectedRole->permissions as $permission)
                                        <div class="flex items-center">
                                            <label for="permission-{{ $permission->id }}"
                                                class="ml-2 text-sm text-gray-700">
                                                {{ $permission->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Mensaje alternativo si $selectedRole es null -->
                    <div class="mt-4">
                        <p class="text-gray-500">{{ __('No se encontraron detalles del rol.') }}</p>
                    </div>
                @endif

                <!-- Botones -->
                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Cerrar') }}
                    </x-secondary-button>
                </div>
            </div>
        </x-modal>
        <!-- Modal Editar Rol -->
        <x-modal name="edit-role-modal" :show="$errors->isNotEmpty()" focusable>
            <form wire:submit.prevent="updateRole">
                <div class="p-4">
                    <h2 class="text-lg font-bold">Editar Rol</h2>

                    <!-- Nombre del Rol -->
                    <div class="mt-4">
                        <x-input-label for="roleName" :value="__('Nombre del Rol')" />
                        <x-text-input id="roleName" type="text" class="mt-1 block w-full"
                            wire:model.defer="storeForm.roleName" disabled />
                        <x-input-error :messages="$errors->get('storeForm.roleName')" class="mt-2" />
                    </div>

                    <!-- Lista de Permisos -->
                    <div class="mt-4">
                        <h3 class="text-md font-semibold">{{ __('Permisos') }}</h3>
                        <div class="grid grid-cols-2 gap-6 mt-4">
                            <div>
                                <div class="grid grid-cols-1 gap-x-4 gap-y-2">
                                    @foreach ($permissions as $permission)
                                        <div class="flex items-center">
                                            <x-checkbox id="permission-{{ $permission->id }}" name="permissions[]"
                                                value="{{ $permission->id }}"
                                                wire:model.defer="storeForm.selectedPermissions" :checked="in_array($permission->id, $selectedPermissions ?? [])" />
                                            <label for="permission-{{ $permission->id }}"
                                                class="ml-2 text-sm text-gray-700">
                                                {{ $permission->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('storeForm.selectedPermissions')" class="mt-2" />
                    </div>

                    <!-- Botones -->
                    <div class="mt-6 flex justify-end">
                        <x-secondary-button x-on:click="$dispatch('close')">
                            {{ __('Cancelar') }}
                        </x-secondary-button>
                        <x-primary-button class="ml-2" wire:target="updateRole" wire:loading.attr="disabled">
                            {{ __('Guardar Cambios') }}
                        </x-primary-button>
                    </div>
                </div>
            </form>
        </x-modal>
        <!-- Modal de Confirmación -->
        <x-modal name="delete-role-modal" :show="$confirmDelete" focusable>
            <form wire:submit.prevent="deleteRole">
                <div class="p-4">
                    <h2 class="text-lg font-bold">Eliminar Rol</h2>
                    <p class="mt-4">¿Estás seguro de que deseas eliminar este rol?</p>

                    <div class="mt-6 flex justify-end">
                        <x-secondary-button x-on:click="$dispatch('close')">
                            {{ __('Cancelar') }}
                        </x-secondary-button>
                        <x-primary-button class="ml-2" wire:target="deleteRole" wire:loading.attr="disabled">
                            {{ __('Eliminar Rol') }}
                        </x-primary-button>
                    </div>
                </div>
            </form>
        </x-modal>
    </div>
</div>
