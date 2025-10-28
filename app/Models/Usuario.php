<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Support\Facades\Redirect;
use Filament\Models\Contracts\HasAvatar;
use Illuminate\Support\Facades\Hash;

// use Laravel\Sanctum\HasApiTokens;


class Usuario extends Authenticatable implements FilamentUser, HasAvatar
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
        'foto_perfil',
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
    public function getNameAttribute()
    {
        return $this->attributes['name_user'];
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name_user'] = $value;
    }

    public function getPasswordAttribute()
    {
        return $this->password_user;
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password_user'] = Hash::make($value);
    }

    public $timestamps = false;


    public function canAccessPanel(Panel $panel): bool
    {
        if($this->type_user != 'ADM'){
            Redirect::to('/login')->send();
            return false;
        }
        return true;
    }

    public function conteudos()
    {
        return $this->hasMany(Conteudo::class, 'autor_id');
    }

    public function getFilamentAvatarUrl(): ?string
    {
        // 1. Verifica se a coluna 'foto_perfil' tem algum valor (não é nulo)
        if ($this->foto_perfil) {
            // 2. Se tiver, retorna a URL pública do caminho salvo no banco de dados.
            //    O asset() usa a APP_URL correta (http://127.0.0.1:8000)
            //    A concatenação '/storage/' é necessária, pois o Filament armazena o caminho
            //    relativo a 'storage/app/public' (ex: fotos_perfil/imagem.jpg)
            return asset('storage/' . $this->foto_perfil);
        }

        // 3. Se não tiver, retorna null, e o Filament usará o avatar padrão (iniciais ou ícone).
        return null; 
    }

    public function getAvatarUrl()
    {
        if ($this->foto_perfil) {
            // 1. Retorna a foto salva no storage
            return asset('storage/' . $this->foto_perfil);
        }

        // 2. Gera um avatar com as iniciais (ex: "Larissa Santos" -> "LS")
        // Você pode trocar 'random' por um código de cor (ex: '007bff')
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&background=random&color=fff';
    }
}
