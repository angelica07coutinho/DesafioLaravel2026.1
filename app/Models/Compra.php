<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $fillable = [
        'id_vendedor',
        'id_cliente',
        'total',
        'status'];
    
    public function itens()
    {
        return $this->hasMany(ItensCompra::class, 'id_compra');
    }

    public function cliente()
    {
        return $this->belongsTo(User::class, 'id_cliente');
    }
    
    public function vendedor()
    {
        return $this->belongsTo(User::class, 'id_vendedor');
    }
}
