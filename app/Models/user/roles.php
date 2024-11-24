<?php

namespace App\Models\user;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class roles extends Model
{
    //
    use 
    HasFactory;

    protected $table = 'user_roles';

    protected $fillable = [
        'roles',
        'descripcion'  
    ];


    public function user() // Una Marca puede tener muchos productos asociados.
    {
        return $this->hasMany(User::class);
    }

    
}
