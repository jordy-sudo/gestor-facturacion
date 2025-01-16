<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItems extends Model
{
    protected $fillable = ['title', 'route', 'icon', 'permission_name', 'parent_id', 'order'];

    // Relación para submenús
    public function children()
    {
        return $this->hasMany(MenuItems::class, 'parent_id')->orderBy('order');
    }
}
