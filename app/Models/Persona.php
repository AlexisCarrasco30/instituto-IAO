<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;

//relacion una persona tiene muchos telefonos 
public function telefonos()
    {
        return $this->hasmany(Telefono::class);
    }

//relacion una persoana tiene un usuario
public function usuario()
    {
        return $this->hasOne(User::class);  
    }
}