<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;


    // Leer las rutas por slug
     public function getRouteKeyName()
     {
        return 'slug';
     }


     //  Relacion 1:n para categorias y establecimientos

     public function establecimientos(){
         return $this->hasMany(Establecimiento::class);
     }
}
