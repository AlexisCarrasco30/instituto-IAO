<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telefono extends Model
{
    use HasFactory;

//Un telefono pertenece a una persona 
public function Persona()
{
    return $this->belongsTo(Persona::class);
}
}
