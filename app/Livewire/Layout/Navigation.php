<?php
namespace App\Livewire\Layout;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache; 

use App\Livewire\Actions\Logout;
use App\Models\MenuItems;

class Navigation extends Component
{
    public $menuItems;

    public function getMenu()
    {
        $user = Auth::user();
        
        $menuItems = Cache::remember('user_menu_' . $user->id, 60, function () use ($user) {
            return MenuItems::with('children')
                ->whereNull('parent_id')
                ->get()
                ->filter(function ($item) use ($user) {
                    return !$item->permission_name || $user->can($item->permission_name);
                })
                ->map(function ($item) use ($user) {
                    $item->children = $item->children->filter(function ($child) use ($user) {
                        return !$child->permission_name || $user->can($child->permission_name);
                    });
                    return $item;
                });
        });

        return $menuItems;
    }

    public function mount()
    {
        $this->menuItems = $this->getMenu();
    }

    public function logout()
    {
        (new Logout())();

        return redirect('/login');
    }

    public function render()
    {   
        return view('livewire.layout.navigation', [
            'menuItems' => $this->menuItems,
        ]);
    }
}
