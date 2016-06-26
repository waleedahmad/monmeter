<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $fillable = [
        'user_id' ,'admin_id', 'location', 'added', 'name', 'job_position', 'static_ip',
        'mac_address'
    ];

    protected $table = 'user_details';
}
