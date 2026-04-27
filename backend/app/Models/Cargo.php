<?php 
namespace App\Models;

use App\Models\BaseModel;

class Cargo extends BaseModel
{
    protected $table = 'cargos';

    protected $fillable = [
        'nombre'
    ];

	/*El modelo Trabajador tiene FK cargo_id*/
    public function trabajadores()
    {
        return $this->hasMany(Trabajador::class);
    }
}
?>