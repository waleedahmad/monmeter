<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'admin_id', 'access', 'name', 'company', 'added', 'card_tag', 'enote'
    ];

    protected $table = 'clients';
}
