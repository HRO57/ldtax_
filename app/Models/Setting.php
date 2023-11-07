<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'key', 'value', 'application_title', 'application_name', 'application_logo', 'application_slider_limit', 'application_main_menu_limit'
    ];
}
