<?php 
namespace App\Models;

use App\Models\BaseModel;

class Proyecto extends BaseModel
{
    protected $table = 'proyectos';

    protected $fillable = [
        'nombre'
    ];

    /*El modelo Trabajador tiene FK cargo_id*/
    public function proyectos()
    {
        return $this->hasMany(Trabajador::class);
    }
}
?>