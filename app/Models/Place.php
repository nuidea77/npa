<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\City;
use TCG\Voyager\Traits\Translatable;



class Place extends Model
{
    use Translatable;
    protected $table = 'places';
    protected $translatable = ['title' , 'description' , 'address' ,'hz_info', 'hz_place', 'animal', 'geography', 'nutgiin', 'hureh', 'aylah', 'service', 'attention', 'zahirgaa'  ];
    public function city()
    {
        return $this->belongsTo(City::class, 'province', 'id');
    }
    public function getTranslated($field)
    {
        return $this->getTranslatedAttribute($field, app()->getLocale());
    }
}
