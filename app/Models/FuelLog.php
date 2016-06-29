<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FuelLog extends Model
{

    protected $table = 'fuel_logs';

    protected $fillable = [
        'id', 'client_id', 'fuel_level', 'admin_id'
    ];

    public function client()
    {
        return $this->belongsTo('App\Models\Client', 'client_id', 'id');
    }
}
