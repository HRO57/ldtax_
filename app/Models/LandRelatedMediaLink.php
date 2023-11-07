<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandRelatedMediaLink extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function scopeStatus($query)
    {
        return $query->where('status', 1);
    }
}
