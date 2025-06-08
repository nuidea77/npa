<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use App\Models\Stamp;

class StampHistory extends Model
{
   use HasFactory;

    protected $fillable = [
        'customer_id',
        'stamp_id',
    ];
    protected $table = 'stamp_histories';
      public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function stamp()
    {
        return $this->belongsTo(Stamp::class);
    }

}
