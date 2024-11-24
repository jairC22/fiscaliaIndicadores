<?php

namespace App\Models\fiscal;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class nombreFiscalia extends Model
{
    
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use 
    HasFactory;

    protected $table = 'nombre_fiscalia';

    protected $fillable = [
        'nombre_fiscalia',
        'descripcion'
    ];

    public function user(){
        return $this->hasMany(fiscalia::class);
    }
}
