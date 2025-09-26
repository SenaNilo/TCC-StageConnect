<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categoria extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $table = 'categorias';

    protected $fillable = [
        'name_category',
    ];

    public function conteudos()
    {
        return $this->belongsToMany(Conteudo::class, 'conteudo_categoria', 'id_categoria', 'id_conteudo');
    }
}
