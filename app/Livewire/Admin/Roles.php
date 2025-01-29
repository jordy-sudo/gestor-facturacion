<?php

namespace App\Livewire\Admin;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Livewire\Component;
use App\Livewire\Forms\Roles\Store;

class Roles extends Component
{
    public Store $storeForm;
    public $roles; 
    public $permissions; 
    public $selectedRole; 
    public $confirmDelete = false;
    public $roleIdToDelete;

    public function mount()
    {
        $this->loadRoles();
        $this->loadPermissions();
    }

    public function render()
    {
        return view('livewire.pages.admin.roles.roles', [
            'roles' => $this->roles,
            'permissions' => $this->permissions,
        ])->layout('layouts.app');
    }

    public function loadRoles()
    {
        $this->roles = Role::with('permissions')->get();
    }
    
    public function loadPermissions()
    {
        $this->permissions = Permission::all();
    }

    public function storeRole()
    {
        $this->storeForm->storeRole();

        $this->loadRoles();
        
        // Emitir evento para cerrar el modal
        session()->flash('success', 'Rol guardado exitosamente.');
        $this->dispatch('close-modal','create-role-modal');
    }

    public function viewRole($roleId)
    {
        $this->selectedRole = Role::with('permissions')->findOrFail($roleId);
        $this->dispatch('open-modal', 'view-role-modal');
    }

    public function editRole($roleId)
    {
        $this->selectedRole = Role::findOrFail($roleId); 
        $this->storeForm->roleName = $this->selectedRole->name; 
        $this->storeForm->selectedPermissions = $this->selectedRole->permissions->pluck('id')->toArray(); 

        $this->dispatch('open-modal', 'edit-role-modal');
    }

    public function updateRole()
    {
        $this->storeForm->updateRole($this->selectedRole->id);

        $this->loadRoles(); 

        session()->flash('success', 'Rol actualizado exitosamente.');
        $this->dispatch('close-modal', 'edit-role-modal'); 
    }

    public function confirmDeleteRole($roleId)
    {
        $this->roleIdToDelete = $roleId;
        $this->dispatch('open-modal', 'delete-role-modal');
    }

    public function deleteRole()
    {
        $role = Role::find($this->roleIdToDelete);

        if ($role) {
            $role->delete();
            session()->flash('success', 'Rol eliminado exitosamente.');
            $this->dispatch('close-modal', 'delete-role-modal');
            $this->loadRoles();
        }
    }
}
