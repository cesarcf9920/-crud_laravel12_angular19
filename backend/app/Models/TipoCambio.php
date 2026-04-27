<?php 
namespace App\Models;

use App\Models\BaseModel;

class TipoCambio extends BaseModel
{
    protected $table = 'tipos_cambios';

    protected $fillable = [
        'nombre'
    ];

	/*El modelo Trabajador tiene FK tipo_cambio_id*/
    public function trabajadores()
    {
        return $this->hasMany(Trabajador::class);
    }
}
?>