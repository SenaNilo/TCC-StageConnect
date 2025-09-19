<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $table = 'tags';

    protected $fillable = [
        'name_tag',
    ];

    public function conteudos()
    {
        return $this->belongsToMany(Conteudo::class, 'conteudo_tag', 'id_tag', 'id_conteudo');
    }
}
