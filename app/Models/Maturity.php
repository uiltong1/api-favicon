<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maturity extends Model
{
    protected $fillable = [
        'service_id',
        'user_id',
        'date_maturity',
        'status'
    ];
}
