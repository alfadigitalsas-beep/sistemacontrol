<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';

    protected $fillable = [
        'nombre',
        'email',
        'telefono',
        'empresa',
        'tipo',
        'direccion',
        'ciudad',
        'pais',
        'notas',
        'activo',
        'fecha_registro'
    ];

    protected $casts = [
        'activo' => 'boolean',
        'fecha_registro' => 'date'
    ];

    const TIPO_COMPRADOR = 'comprador';
    const TIPO_ARRENDATARIO = 'arrendatario';
    const TIPO_AMBOS = 'ambos';

    public static function getTipos(): array
    {
        return [
            self::TIPO_COMPRADOR => 'Comprador',
            self::TIPO_ARRENDATARIO => 'Arrendatario',
            self::TIPO_AMBOS => 'Ambos'
        ];
    }

    public function licencias(): HasMany
    {
        return $this->hasMany(Licencia::class);
    }

    public function transacciones(): HasMany
    {
        return $this->hasMany(Transaccion::class);
    }

    public function getTipoLabelAttribute(): string
    {
        return self::getTipos()[$this->tipo] ?? $this->tipo;
    }

    public function getInicialesAttribute(): string
    {
        $nombres = explode(' ', $this->nombre);
        $iniciales = '';
        foreach (array_slice($nombres, 0, 2) as $nombre) {
            $iniciales .= strtoupper(substr($nombre, 0, 1));
        }
        return $iniciales;
    }

    public function scopeActivos($query)
    {
        return $query->where('activo', true);
    }

    public function scopePorTipo($query, $tipo)
    {
        return $query->where('tipo', $tipo);
    }
}
