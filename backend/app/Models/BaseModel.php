<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    protected $guarded = [];

    // Scope Todas tus tablas tienen activo
	// Es una regla general del sistema
	// Quieres reutilizar en muchos módulos

    public function scopeActivo($query)// es necesario ->activo() para filtrar
    {
        return $query->where('activo', 1);
    }
    
    public function scopeInactivo($query)
{
    return $query->where('activo', 0);
}
}
?>