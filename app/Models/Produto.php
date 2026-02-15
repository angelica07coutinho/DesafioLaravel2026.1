<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'descricao',
        'foto_produto',
        'preco',
        'quantidade',
        'status',
        'id_vendedor',
        'id_categoria',
    ];

    public function vendedor()
    {
        return $this->belongsTo(User::class, 'id_vendedor');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }
}
