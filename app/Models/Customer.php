<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;








class Customer extends Model implements AuthenticatableContract
{
    use Authenticatable;
    protected $table = 'customers';

    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'phone',
        'position',
        'password',
        'hz',
        'avatar',
    ];

    // Add any additional attributes or relationships needed
}

