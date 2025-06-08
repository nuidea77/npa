<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_id',
        'customer_id',
        'firstname',
        'lastname',
        'hz',
        'position',
        'gender',
        'email',
        'phone',
        'answer',
        'registered_at',
    ];

    protected $dates = [
        'registered_at',
    ];

    public $timestamps = false;

    // Хөтөлбөртэй харьцах relation
    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    // Customer relation (хэрэв хэрэглэгч login хийсэн байвал)
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
