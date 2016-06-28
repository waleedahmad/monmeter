<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TankLog extends Model
{
    protected $table = 'tank_logs';

    protected $fillable = [
        'id', 'admin_id', 'fuel_level'
    ];
}
