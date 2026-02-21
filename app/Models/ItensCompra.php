<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItensCompra extends Model
{
    protected $fillable = [
        'id_compra', 
        'id_produto', 
        'quantidade', 
        'preco'];

    public function pedido()
    {
        return $this->belongsTo(Compra::class);
    }

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }
}
