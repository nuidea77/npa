<?php

namespace App\Models;
use App\Models\StampHistory;
use App\Models\ProtectedArea;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;

class Customer extends Model implements AuthenticatableContract
{
    use Authenticatable;
    use HasFactory, Notifiable;


    protected $table = 'customers';

    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'phone',
        'position',
        'password',
        'protected_areas_id',
        'avatar',
    ];
  public function protectedArea()
    {
        return $this->belongsTo(ProtectedArea::class, 'protected_area_id');
    }

    public function stampHistories()
    {
        return $this->hasMany(StampHistory::class, 'protected_area_id', 'protected_area_id');
    }

}

