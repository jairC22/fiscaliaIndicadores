<?php

namespace App\Models\fiscal;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class areaFiscalia extends Model
{
    //
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use 
    HasFactory;

    protected $table = 'area_fiscalia';

    protected $fillable = [
        'nombre',
        'telefono',
        'descripcion',
    
    ];

    public function fiscalia(){
        return $this->hasMany(fiscalia::class);
    }
}
