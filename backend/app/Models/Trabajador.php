<?php 
namespace App\Models;

use App\Models\BaseModel;
use App\Traits\HasAudit;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trabajador extends BaseModel
{
    use HasAudit;/*usuario que crea o modifica*/
    use SoftDeletes;
    //sin no quiero guardar fechas usar created_at  y updated_at entonces   public $timestamps = false;
    //Laravel: llena created_at al crear y actualiza updated_at entonces $model->created_at = now(); y$model->updated_at = now();
    protected $table = 'trabajadores';

    protected $fillable = [
        'nombre',
        'cargo_id',
        'proyecto_id',
        'tipo_pago_id',
        'tipo_cambio_id',
        'activo'
    ];

    //Siempre filtro activo=1
    /*protected static function booted()
    {
        static::addGlobalScope('activo', function ($query) {
            $query->where('activo', 1);
        });
    }*/

    // Pertenece a un cargo tiene FK cargo_id
    public function cargo()
    {
        return $this->belongsTo(Cargo::class);
    }

    // Pertenece a un proyecto tiene FK proyecto_id
    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class);
    }

    // Pertenece a un proyecto tiene FK tipo_pago_id
    public function tipo_pago()
    {
        return $this->belongsTo(TipoPago::class);
    }

    // Pertenece a un proyecto tiene FK proyecto_id
    public function tipo_cambio()
    {
        return $this->belongsTo(TipoCambio::class);
    }

    public function scopeActivo($query)
    {
        return $query->where('activo', 1);
    }
    
    public function scopeSearch($query, $value)
    {
        if ($value) {
            $query->where('nombre', 'like', "%{$value}%");
        }
    }

    public function scopeCargo($query, $cargoId)
    {
        if ($cargoId) {
            $query->where('cargo_id', $cargoId);
        }
    }

    public function scopeEstado($query, $estado)
    {
        if (!is_null($estado)) {
            $query->where('activo', $estado);
        }
    }
}
?>