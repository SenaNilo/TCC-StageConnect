<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
// use Laravel\Sanctum\HasApiTokens;


class Usuario extends Authenticatable
{
    
    use HasFactory, Notifiable;

    // Define o nome da tabela no banco de dados
    protected $table = 'usuarios';

    // Define a chave primária da tabela
    protected $primaryKey = 'id';

    // Define os atributos que podem ser preenchidos em massa
    protected $fillable = [
        'name_user',
        'email',
        'password_user',
        'type_user', 
        'active_user',
    ];

    // Define os atributos que devem ser ocultados ao serializar o modelo para arrays/JSON.
    protected $hidden = [
        'password_user', // Oculta a senha
    ];

    // Define os atributos que devem ser convertidos para tipos nativos.
    // 'password_user' será automaticamente hashado pelo Laravel se você usar o método setPasswordAttribute
    // Ou você pode fazer o hash manualmente antes de salvar.
    protected $casts = [
        'dt_created' => 'datetime',
        'active_user' => 'boolean',
    ];

    /**
     * Sobrescreve o método getAuthPassword para usar 'password_user' como campo de senha.
     * Isso é necessário porque o Laravel espera 'password' por padrão.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password_user;
    }
    public function getNameAttribute(): string
    {
        return $this->attributes['name_user'];
    }

    public $timestamps = false;

}
