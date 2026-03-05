<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Insurance extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nombre_empresa',
        'telefono_contacto',
        'notas_adicionales',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Accessor: retorna created_at formateado como "15 de enero de 2025" en español (México).
     * Se usa translatedFormat() de Carbon (más robusto que isoFormat para locales con soporte parcial).
     */
    public function getFechaRegistroAttribute(): string
    {
        return $this->created_at
            ->locale('es_MX')
            ->translatedFormat('j \d\e F \d\e Y');
    }
}
