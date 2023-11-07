<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $guarded = [];

    public function scopeStatus($query)
        {
            return $query->where('status', 1);
        }
    
    use HasFactory;
    
}
    