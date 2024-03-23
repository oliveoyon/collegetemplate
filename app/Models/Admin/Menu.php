<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    public function subMenus()
    {
        return $this->hasMany(SubMenu::class, 'menu_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'dept_id');
    }


}
