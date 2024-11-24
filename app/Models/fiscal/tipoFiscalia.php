<?php

namespace App\Models\fiscal;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class tipoFiscalia extends Model
{
    //
    use 
    HasFactory;

    protected $table = 'tipo_fiscalia';

    protected $fillable = [
        'nombre_tipo',
        'descripcion'
    ];

    public function user(){
        return $this->hasMany(fiscalia::class);
    }
}
