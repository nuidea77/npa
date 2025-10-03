<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;
use App\Models\Customer;
use App\Models\StampHistory;

class ProtectedArea extends Model
{
    use Translatable;

    protected $table = 'protected_areas';

    protected $fillable = ['name'];

    public $translatable = ['name'];

       public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
     public function stampHistories()
    {
        return $this->hasMany(StampHistory::class, 'protected_area_id');
    }
}
