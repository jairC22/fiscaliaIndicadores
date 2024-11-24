<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;


use App\Models\fiscal\fiscalia;
use App\Models\user\roles;
use App\Models\user\Sesion;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use
        HasApiTokens,
        HasFactory,
        Notifiable,
        MustVerifyEmail;

    //public $incrementing = false; // Desactiva el incremento automático
    //protected $keyType = 'string'; // Define el tipo de la clave primaria como 'string'

    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'nombre',
        'apellido',
        'telefono',
        'email',
        'dni',
        'direccion',
        'sexo',
        'fecha_nacimiento',
        'foto_perfil',
        'extension', // nuemro de telefono del area
        'tipo_fiscal',
        'activo',
        'fecha_ingreso',
        'email_verified_at',
        'password',
        'estado',
        'fiscalia_fk',
        'roles_fk',
        //'session_fk'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        // Generar un UUID solo para el campo 'uuid'
        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = Str::uuid()->toString();
            }
        });
    }


    public function fiscalia_fk(): BelongsTo
    {
        return $this->belongsTo(fiscalia::class, 'fiscalia_fk');
    }
    
    public function roles_fk()
    {
        return $this->belongsTo(roles::class, 'roles_fk');
    }

    public function sesionUser()
    {
        return $this->hasMany(Sesion::class);
    }
}
