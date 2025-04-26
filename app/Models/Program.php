<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class Program extends Model
{
    protected $table = 'programs';
    use Translatable;
    protected $translatable = ['title', 'excerpt', 'description'];
    use HasFactory;
    public function getTranslated($field)
    {
        return $this->getTranslatedAttribute($field, app()->getLocale());
    }
}
