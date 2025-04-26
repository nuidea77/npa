<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;


class Lesson extends Model
{
    use Translatable;
    protected $table = 'lessons';
    protected $translatable = ['title', 'description'];
    public function getTranslated($field)
    {
        return $this->getTranslatedAttribute($field, app()->getLocale());
    }

}
