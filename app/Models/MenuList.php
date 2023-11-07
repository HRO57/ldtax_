<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuList extends Model
{
    public function parent()
    {
        return $this->belongsTo(MenuList::class, 'parent_id');
    }

    public function scopeStatus($query)
    {
        return $query->where('status', 1);
    }
    
    protected $guarded = [];
    use HasFactory;
}
