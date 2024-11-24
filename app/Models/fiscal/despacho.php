<?php

namespace App\Models\fiscal;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class despacho extends Model
{

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use 
    HasFactory;

    protected $table = 'despacho';

    protected $fillable = [
        'area_fis_fk',
        'nombre_fis_fk',
        'tipo_fk',
        'despacho_fk',
        'descripcion',
    
    ];

    public function fiscalia(){
        return $this->hasMany(fiscalia::class);
    }
}
