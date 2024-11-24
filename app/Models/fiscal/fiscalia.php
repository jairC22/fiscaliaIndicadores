<?php

namespace App\Models\fiscal;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class fiscalia extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use
        HasFactory;

    //public $incrementing = false; // Desactiva el incremento automático
    //protected $keyType = 'string'; // Define el tipo de la clave primaria como 'string'

    protected $table = 'fiscalia';

    protected $fillable = [
        'area_fis_fk',
        'nombre_fis_fk',
        'tipo_fk',
        'despacho_fk',
        'descripcion',

    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function areaFiscalia(): BelongsTo
    {
        return $this->belongsTo(areaFiscalia::class);
    }
    
    public function despacho(): BelongsTo
    {
        return $this->belongsTo(despacho::class);
    }

    public function nombreFiscalia(): BelongsTo
    {
        return $this->belongsTo(nombreFiscalia::class);
    }
    
    public function tipoFiscalia(): BelongsTo
    {
        return $this->belongsTo(tipoFiscalia::class);
    }
    
}
