<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;
 /**
 * Obtener teléfono de una persona.
 */
public function telefonos()
{
    return $this->hasone(Telefono::class);
}

//relacion una persona tiene un usuario
public function usuario()
    {
        return $this->hasOne(User::class);  
    }
//relacion una persona tiene un usuario
public function CalsificacionAlumno()
    {
        return $this->hasOne(CalsificacionAlumno::class);  
    }
}