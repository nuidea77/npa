<?php

namespace App\Models;
use App\Models\StampHistory;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
public function stamps()
{
    return $this->belongsToMany(Stamp::class, 'stamp_histories');
}





}

