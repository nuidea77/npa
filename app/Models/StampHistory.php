<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StampHistory extends Model
{
    protected $table = 'stamp_histories';

    protected $fillable = [
        'protected_area_id',
        'stamp_id',
        'assigned_date',
    ];

    protected $casts = [
        'assigned_date' => 'date',
    ];

    // Relationships
    public function protectedArea()
    {
        return $this->belongsTo(ProtectedArea::class, 'protected_area_id');
    }

    public function stamp()
    {
        return $this->belongsTo(Stamp::class, 'stamp_id');
    }
}
