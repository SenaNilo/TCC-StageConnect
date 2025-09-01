<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Conteudo extends Model
{
    use HasFactory;

    // Define o nome da tabela no banco de dados
    protected $table = 'conteudos';

    // Define os atributos que podem ser preenchidos em massa
    protected $fillable = [
        'autor_id',
        'titulo',
        'descricao',
        'active_content',
    ];

    // Define os atributos que devem ser convertidos para tipos nativos
    protected $casts = [
        'active_content' => 'boolean',
        'dt_created' => 'datetime',
        'dt_updated' => 'datetime',
    ];

    // Desativa os timestamps padrão do Laravel para usar as colunas dt_created e dt_updated
    public $timestamps = false;
    
    // Sobrescreve o método de salvamento para definir os timestamps personalizados
    protected static function booted()
    {
        static::creating(function ($conteudo) {
            $conteudo->dt_created = now();
            $conteudo->dt_updated = now();
        });

        static::updating(function ($conteudo) {
            $conteudo->dt_updated = now();
        });
    }

    /**
     * Define a relação com o modelo de usuário para o campo autor_id.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function autor(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'autor_id');
    }
}