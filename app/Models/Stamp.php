<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\StampHistory;
use App\Models\ProtectedArea;
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

public function protectedArea()
{
    return $this->belongsToMany(ProtectedArea::class, 'stamp_histories');
}



}
