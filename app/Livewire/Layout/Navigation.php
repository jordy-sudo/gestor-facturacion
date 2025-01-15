<?php

namespace App\Livewire\Layout;

use Livewire\Component;

class Navigation extends Component
{
    public $menu = [
        [
            'label' => 'Dashboard',
            'icon' => 'heroicon-o-home',
            'route' => 'dashboard',
            'active' => false,
        ],
        [
            'label' => 'Profile',
            'icon' => 'heroicon-o-user',
            'route' => 'profile',
            'active' => false,
        ],
        [
            'label' => 'Settings',
            'icon' => 'heroicon-o-cog',
            'route' => null,
            'active' => false,
            'submenu' => [
                [
                    'label' => 'Account',
                    'route' => 'settings.account',
                    'active' => false,
                ],
                [
                    'label' => 'Privacy',
                    'route' => 'settings.privacy',
                    'active' => false,
                ],
            ],
        ],
    ];

    public function setActiveMenu($route)
    {
        foreach ($this->menu as &$item) {
            $item['active'] = $item['route'] === $route;

            if (isset($item['submenu'])) {
                foreach ($item['submenu'] as &$subItem) {
                    $subItem['active'] = $subItem['route'] === $route;
                }
            }
        }
    }

    public function render()
    {
        return view('livewire.layout.navigation');
    }
}
