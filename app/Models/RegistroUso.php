<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RegistroUso extends Model
{
    use HasFactory;

    protected $table = 'registros_uso';

    protected $fillable = [
        'licencia_id',
        'usuario_nombre',
        'usuario_email',
        'dispositivo',
        'ip_address',
        'fecha_acceso',
        'accion',
        'estado'
    ];

    protected $casts = [
        'fecha_acceso' => 'datetime'
    ];

    const ACCION_ACTIVACION = 'activacion';
    const ACCION_DESACTIVACION = 'desactivacion';
    const ACCION_LOGIN = 'login';
    const ACCION_LOGOUT = 'logout';
    const ACCION_BLOQUEO = 'bloqueo';

    const ESTADO_ACTIVO = 'activo';
    const ESTADO_INACTIVO = 'inactivo';
    const ESTADO_BLOQUEADO = 'bloqueado';

    public static function getAcciones(): array
    {
        return [
            self::ACCION_ACTIVACION => 'Activación',
            self::ACCION_DESACTIVACION => 'Desactivación',
            self::ACCION_LOGIN => 'Inicio de sesión',
            self::ACCION_LOGOUT => 'Cierre de sesión',
            self::ACCION_BLOQUEO => 'Bloqueo'
        ];
    }

    public static function getEstados(): array
    {
        return [
            self::ESTADO_ACTIVO => 'Activo',
            self::ESTADO_INACTIVO => 'Inactivo',
            self::ESTADO_BLOQUEADO => 'Bloqueado'
        ];
    }

    public function licencia(): BelongsTo
    {
        return $this->belongsTo(Licencia::class);
    }

    public function getAccionLabelAttribute(): string
    {
        return self::getAcciones()[$this->accion] ?? $this->accion;
    }

    public function getEstadoLabelAttribute(): string
    {
        return self::getEstados()[$this->estado] ?? $this->estado;
    }

    public function scopePorLicencia($query, $licenciaId)
    {
        return $query->where('licencia_id', $licenciaId);
    }

    public function scopePorAccion($query, $accion)
    {
        return $query->where('accion', $accion);
    }

    public function scopeHoy($query)
    {
        return $query->whereDate('fecha_acceso', today());
    }

    public function scopeRecientes($query, $limite = 10)
    {
        return $query->orderBy('fecha_acceso', 'desc')->limit($limite);
    }
}
