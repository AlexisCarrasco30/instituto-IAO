<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profesion extends Model
{
    use HasFactory;
    protected $table = ['profesiones'];

    //relacion una profesion tiene muchas materias
    public function Materias()
    {   
        return $this->hasmany(Materia::class);
    }
}
