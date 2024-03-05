<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubMenu extends Model
{
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }
}
