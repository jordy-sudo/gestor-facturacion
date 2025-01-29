<?php

namespace App\Livewire\Forms\Roles;

use Livewire\Attributes\Validate;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Livewire\Form;

class Store extends Form
{
    #[Validate('required|string|max:255')]
    public string $roleName = '';

    #[Validate('required|array|min:1')]
    public array $selectedPermissions = [];

    
    public function storeRole()
    {
        $validatedData = $this->validate();

        $role = Role::create(['name' => $this->roleName]);

        $role->permissions()->sync($this->selectedPermissions);

        $this->reset(['roleName', 'selectedPermissions']);

        session()->flash('success', 'Rol creado correctamente.');
    }

    public function updateRole($roleId)
    {
        $validatedData = $this->validate();
        $role = Role::findOrFail($roleId);
        $role->name = $this->roleName;
        $role->save();

        $role->permissions()->sync($this->selectedPermissions);

        $this->reset(['roleName', 'selectedPermissions']);

        session()->flash('success', 'Rol actualizado correctamente.');
    }
}
