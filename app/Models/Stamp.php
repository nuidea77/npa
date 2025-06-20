<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\StampHistory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Stamp extends Model
{
    use HasFactory;




    protected $fillable = [
        'name',
        'description',
        'image',
        'created_at',
        'updated_at'
    ];

    protected $table = 'stamps';

public function customers()
{
    return $this->belongsToMany(Customer::class, 'stamp_histories');
}



}
