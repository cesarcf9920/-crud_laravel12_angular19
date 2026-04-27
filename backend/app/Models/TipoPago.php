<?php 
namespace App\Models;

use App\Models\BaseModel;

class TipoPago extends BaseModel
{
    protected $table = 'tipos_pagos';

    protected $fillable = [
        'nombre'
    ];

	/*El modelo Trabajador tiene FK tipo_pago_id*/
    public function trabajadores()
    {
        return $this->hasMany(Trabajador::class);
    }
}
?>