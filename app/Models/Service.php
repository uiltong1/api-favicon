<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{

    protected $fillable = [
        'name',
        'ds_service',
        'fixed_value',
        'status',
        'periodic',
        'date_init',
        'date_end',
        'value',
        'user_id',
        'reminder'
    ];
}
