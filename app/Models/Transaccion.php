<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaccion extends Model
{
    use HasFactory;

    protected $table = 'transacciones';

    protected $fillable = [
        'cliente_id',
        'licencia_id',
        'tipo',
        'monto',
        'fecha',
        'metodo_pago',
        'descripcion'
    ];

    protected $casts = [
        'fecha' => 'date',
        'monto' => 'decimal:2'
    ];

    const TIPO_VENTA = 'venta';
    const TIPO_ALQUILER = 'alquiler';
    const TIPO_RENOVACION = 'renovacion';
    const TIPO_REEMBOLSO = 'reembolso';

    const METODO_TARJETA = 'tarjeta';
    const METODO_TRANSFERENCIA = 'transferencia';
    const METODO_EFECTIVO = 'efectivo';
    const METODO_OTRO = 'otro';

    public static function getTipos(): array
    {
        return [
            self::TIPO_VENTA => 'Venta',
            self::TIPO_ALQUILER => 'Alquiler',
            self::TIPO_RENOVACION => 'Renovación',
            self::TIPO_REEMBOLSO => 'Reembolso'
        ];
    }

    public static function getMetodosPago(): array
    {
        return [
            self::METODO_TARJETA => 'Tarjeta',
            self::METODO_TRANSFERENCIA => 'Transferencia',
            self::METODO_EFECTIVO => 'Efectivo',
            self::METODO_OTRO => 'Otro'
        ];
    }

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }

    public function licencia(): BelongsTo
    {
        return $this->belongsTo(Licencia::class);
    }

    public function getTipoLabelAttribute(): string
    {
        return self::getTipos()[$this->tipo] ?? $this->tipo;
    }

    public function getMetodoPagoLabelAttribute(): string
    {
        return self::getMetodosPago()[$this->metodo_pago] ?? $this->metodo_pago;
    }

    public function getMontoFormateadoAttribute(): string
    {
        return '$' . number_format($this->monto, 0, ',', '.');
    }

    public function scopePorTipo($query, $tipo)
    {
        return $query->where('tipo', $tipo);
    }

    public function scopePorCliente($query, $clienteId)
    {
        return $query->where('cliente_id', $clienteId);
    }

    public function scopePorAnio($query, $anio)
    {
        return $query->whereYear('fecha', $anio);
    }

    public function scopePorMes($query, $anio, $mes)
    {
        return $query->whereYear('fecha', $anio)
                     ->whereMonth('fecha', $mes);
    }

    public function scopeEsteMes($query)
    {
        return $query->whereMonth('fecha', now()->month)
                     ->whereYear('fecha', now()->year);
    }

    public function scopeEsteAnio($query)
    {
        return $query->whereYear('fecha', now()->year);
    }
}
